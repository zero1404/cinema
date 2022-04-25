<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Vanthao03596\HCVN\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StatusNotification;
use Helpers;

class HomeController extends Controller
{
    private function orderBy(string $key)
    {
        $orderBy = [
            'new' => ['id', 'DESC'],
            'old' => ['id', 'ASC'],
            'sold' => ['sold', 'DESC'],
            'lowPrice' => ['price', 'ASC'],
            'highPrice' => ['price', 'DESC']
        ];
        return isset($orderBy[$key]) ? $orderBy[$key] : $orderBy['new'];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('created_at', 'DESC')->where('status', 'active')->paginate(12);
        $productsHot = Product::orderBy('sold', 'DESC')->where('status', 'active')->paginate(8);

        if ($request->ajax()) {
            $html = view('shop.product.list', compact('products'))->render();
            return response()->json($html);
        }
        return view('shop.home', compact('products', 'productsHot'));
    }

    public function showContact()
    {
        return view('shop.contact.index');
    }

    public function productSearch(Request $request)
    {
        $paginate = $request->paginate ?? 8;
        $sort = $request->sort ?? 'new';
        $orderBy = $this->orderBy($sort);
        $keyword = $request->keyword;
        $products = Product::orwhere('title', 'like', '%' . $keyword . '%')
            ->orwhere('slug', 'like', '%' . $keyword . '%')
            //->orwhere('description', 'like', '%' . $request->search . '%')
            ->orwhere('price', 'like', '%' . $keyword . '%')
            ->orderBy($orderBy[0], $orderBy[1])
            ->paginate($paginate);
        return view('shop.product.search', compact('products', 'keyword', 'sort', 'paginate'));
    }

    public function productList(Request $request)
    {
        $paginate = $request->paginate ?? 8;
        $sort = $request->sort ?? 'new';
        $orderBy = $this->orderBy($sort);
        $products = Product::orderBy($orderBy[0], $orderBy[1])->where('status', 'active')->paginate($paginate);
        return view('shop.product.index', compact('products', 'paginate', 'sort'));
    }

    public function productDetail($slug)
    {
        $product = Product::getBySlug($slug);
        if (!$product) {
            abort(404);
        }
        $related_products = Category::find($product->category_id)->products->take(4);
        return view('shop.product.detail', compact('product', 'related_products'));
    }

    public function productByCategory(Request $request, $slug)
    {
        $paginate = $request->paginate ?? 8;
        $sort = $request->sort ?? 'new';
        $orderBy = $this->orderBy($sort);
        $category = Category::getBySlug($slug);
        $products = $category->products()->paginate($paginate);
        if ($category->parent == null) {
            $children_id = Category::getChildrenIds($category->id);
            $products = Product::whereIn('category_id', $children_id)->paginate($paginate);
        }
        return view('shop.product.index', compact('products', 'category', 'paginate', 'sort'));
    }

    public function login()
    {
        return view('shop.user.login');
    }

    public function register()
    {
        return view('shop.user.register');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('shop.user.profile', compact('user'));
    }

    public function changePassword()
    {
        $user = Auth::user();
        return view('shop.user.change-password', compact('user'));
    }

    public function checkout()
    {
        $carts = Cart::getCart();
        if (!$carts || $carts->count == 0) {
            return redirect()->route('shop.home');
        }
        if (session('coupon')) {
            $coupon = Coupon::find(session('coupon')['id']);
            if (!Helpers::isValidCoupon($coupon)) {
                session()->forget('coupon');
            }
        }
        $user = Auth::user();
        $provinces = Province::get();
        $discount_money = Helpers::getDiscountMoney($carts->total);
        return view('shop.user.checkout', compact('user', 'carts', 'provinces', 'discount_money'));
    }

    public function getOrderList()
    {
        $orders = Order::getListOrdered();
        return view('shop.user.list-ordered', compact('orders'));
    }

    public function getDetailOrder($id)
    {
        $order = Order::find($id);
        return view('shop.user.detail-ordered', compact('order'));
    }

    public function order(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'firstname' => 'string|required',
                'lastname' => 'string|required',
                'address' => 'string|required',
                'telephone' => 'numeric|required',
                'email' => 'string|required',
                'note' => 'string|nullable',
                'coupon' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => 'Chưa nhập thông tin thanh toán', 'type' => 'empty-form'], 400);
            }
            $carts = Cart::getCart();
            if (empty($carts)) {
                return response()->json(['message' => 'Giỏ hàng trống', 'type' => 'cart-empty'], 400);
            }

            $order = new Order();
            $data = $request->all();
            $full_address = $request->input('address') . ", " . $request->input('ward') . ", " . $request->input('district') . ", " . $request->input('province');
            $data['address'] = $full_address;
            if (session('coupon')) {
                $coupon = Coupon::find(session('coupon')['id']);
                if (!Helpers::isValidCoupon($coupon)) {
                    session()->forget('coupon');
                }
            }
            $discount_money = Helpers::getDiscountMoney($carts->total);
            $order['order_number'] = Helpers::generateOrderNumber(Order::count());
            $order['user_id'] = Auth::id();
            $order['address'] = $full_address;
            $order['status'] = 'new';
            $order['discount'] = $discount_money;
            $order->total = $carts->total - $discount_money;
            $order->fill($data)->save();

            $order_items = [];
            foreach ($carts->items as $item) {
                $order_items[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'price' => $item->quantity * $item->product->price,
                ];
            }
            OrderDetail::insert($order_items);

            $carts->status = 'inactive';
            $carts->save();

            if (session('coupon')) {
                $coupon = Coupon::find(session('coupon')['id']);
                if ($coupon) {
                    $currentTime = $coupon->times;
                    $coupon->times = $currentTime > 1 ? $currentTime - 1 : 0;
                    if ($currentTime == 1) $coupon->status = 'inactive';
                    $coupon->save();
                }
                session()->forget('coupon');
            }
            $request->session()->put('order-success', true);
            $details = [
                'title' => 'Có đơn đặt hàng mới',
                'content' => auth()->user()->fullname . " đã tạo đơn hàng mới",
                'actionURL' => route('order.show', $order->id),
                'fas' => 'fa-cart-plus'
            ];

            $users = User::whereIn('role', ['admin', 'customer'])->get();

            Notification::send($users, new StatusNotification($details));
            return response()->json(['message' => 'Successful'], 200);
        }
    }

    public function orderSuccess(Request $request)
    {
        if ($request->session()->has('order-success')) {
            $request->session()->forget('order-success');
            return view('shop.order.success');
        }
        return redirect()->route('shop.list-ordered');
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)
            ->where('status', 'active')
            ->where('times', '>', 0)
            ->first();

        if (!$coupon) {
            session()->forget('coupon');
            request()->session()->flash('error-coupon', 'Mã phiếu giảm giá không hợp lệ, Vui lòng thử lại');
            return back();
        }
        if ($coupon) {
            session()->put('coupon', [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'value' => $coupon->value
            ]);
            request()->session()->flash('success-coupon', 'Phiếu giảm giá đã được áp dụng thành công');
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $messages = [
            'firstname.string' => 'Tên phải là chuỗi kí tự',
            'firstname.required' => 'Tên không được bỏ trống',
            'firstname.max' => 'Tên không được vượt quá 100 kí tự',
            'lastname.string' => 'Họ phải là chuỗi kí tự',
            'lastname.required' => 'Họ không được bỏ trống',
            'lastname.max' => 'Họ không được vượt quá 100 kí tự',
            'address.required' => 'Địa chỉ không được bỏ trống',
            'address.string' => 'Địa chỉ phải là chuỗi kí tự',
            'province.required' => 'Tỉnh không được bỏ trống',
            'province.string' => 'Tỉnh phải là chuỗi kí tự',
            'district.required' => 'Quận/huyện không được bỏ trống',
            'district.string' => 'Quận/huyện phải là chuỗi kí tự',
            'ward.required' => 'Phường/xã không được bỏ trống',
            'ward.string' => 'Phường/xã phải là chuỗi kí tự',
            'email.required' => 'Email không được bỏ trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email không có sẵn',
            'telephone.required' => 'Số điện thoại không được bỏ trống',
            'telephone.string' => 'Số điện thoại phải là chuỗi kí tự',
            'telephone.min' => 'Số điện thoại không được nhỏ hơn 10 kí tự',
            'telephone.max' => 'Số điện thoại không được lớn hơn 10 kí tự',
        ];

        $this->validate($request, [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'address' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'telephone' => 'required|string|min:10|max:10',
        ], $messages);

        if ($request->email != $user->email) {
            $this->validate($request, ['email' => 'required|email|unique:users,email,' . $user->email], $messages);
        }
        $data = $request->all();

        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('shop.profile');
    }

    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $messages = [
            'oldpassword.required' => 'Mật khẩu hiện tại không được bỏ trống',
            'oldpassword.string' => 'Mật khẩu hiện tại phải là chuỗi kí tự',
            'password.required' => 'Mật khẩu mới không được bỏ trống',
            'password.string' => 'Mật khẩu mới phải là chuỗi kí tự',
            'password.different' => 'Mật khẩu mới phải khác với mật khẩu hiện tại',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.string' => 'Mật khẩu xác nhận phải là chuỗi kí tự',
            'repassword.same' => 'Mật khẩu xác nhận phải giống với mật khẩu mới',
        ];

        $this->validate($request, [
            'oldpassword' => ['required', 'string', new MatchOldPassword],
            'password' => 'string|required|different:oldpassword',
            'repassword' => 'string|required|same:password',
        ], $messages);

        $user->password = Hash::make($request->password);
        $status = $user->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật mật khẩu thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('shop.change-password-profile');
    }

    public function updateAvatar(Request $request)
    {
        $user = User::find(Auth::id());
        $currentAvatar = $user->avatar;
        $messages = [
            'avatar.required' => 'Chưa chọn ảnh',
            'avatar.image' => 'Tệp tin phải là ảnh',
            'avatar.mimes' => 'Định dạnh ảnh không cho phép'
        ];
        $this->validate($request, ['avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|required'], $messages);
        $image = $request->file('avatar');
        $storedPath = $image->move('images/avatar', Str::uuid() . '.' . $image->extension());
        $user->avatar = $storedPath;
        $status = $user->save();
        if ($status) {
            if ($currentAvatar != $storedPath) {
                Storage::delete($currentAvatar);
            }
            request()->session()->flash('success', 'Cập nhật ảnh đại diện thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('shop.profile');
    }
}
