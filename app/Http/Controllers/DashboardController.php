<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Address;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Language;
use App\Models\Publisher;
use App\Models\Author;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $count_product = Product::getCountActiveProduct();
        $count_category = Category::getCountCategory();
        $count_order = Order::getCountActiveOrder();
        $count_user = User::getCountActiveUser();
        $count_coupon = Coupon::getCountActiveVoucher();
        $count_language = Language::getCountLanguage();
        $count_author = Author::getCountAuthor();
        $count_publisher = Publisher::getCountPublisher();

        $data = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $users[] = ['Name', 'Number'];
        foreach ($data as $key => $value) {
            $users[++$key] = [$value->day_name, $value->count];
        }
        return view('dashboard.home.index', compact(
            'count_product',
            'count_category',
            'count_order',
            'count_user',
            'count_coupon',
            'count_publisher',
            'count_language',
            'count_author'
        ))->with('users', json_encode($users));
    }

    public function fileManager()
    {
        return view('dashboard.file-manager.index');
    }

    public function showProfile()
    {
        return view('dashboard.auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        if (!$user) {
            Session::flush();
            Auth::logout();
            return redirect('dashboard.login');
        }

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
            'avatar' => 'nullable|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'telephone' => 'required|string|max:10',
        ], $messages);

        if ($request->input('email') != $user->email) {
            $this->validate($request, [
                'email' => 'required|email|unique:users',
            ], $messages);
        }

        $data = $request->all();

        if ($request->input('address')) {
            $this->validate($request, [
                'province' => 'required|string',
                'district' => 'required|string',
                'ward' => 'required|string',
            ], $messages);

            $address = null;
            if ($user->address) {
                $address = Address::find($user->address_id);
            } else {
                $address = new Address();
            }
            $address->address = $data['address'];
            $address->address = $data['address'];
            $address->province_id = $data['province'];
            $address->district_id = $data['district'];
            $address->ward_id = $data['ward'];
            $address->save();
            $data['address_id'] = $address->id;
        }

        $data['birthday'] = \Carbon\Carbon::parse($request->input('birthday'));
        $data['gender'] = $request->input('gender') == 'male';

        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật thông tin tài khoản thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('dashboard.profile');
    }

    public function showUpdatePassword()
    {
        return view('dashboard.auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $messages = [
            'oldpassword.required' => 'Mật khẩu hiện tại không được bỏ trống',
            'password.required' => 'Mật khẩu thoại không được bỏ trống',
            'password.string' => 'Mật khẩu phải là chuỗi kí tự',
            'repassword.required' => 'Mật khẩu xác nhận không được bỏ trống',
            'repassword.string' => 'Mật khẩu xác nhận phải là chuỗi kí tự',
            'repassword.same' => 'Mật khẩu xác nhận không giống với mật khẩu',
        ];

        $user = User::find(Auth::id());

        $data = $request->all();


        $this->validate(
            $request,
            [
                'oldpassword' => ['required', 'string', new MatchOldPassword],
                'password' => 'required|string',
                'repassword' => 'required|string|same:password',
            ],
            $messages
        );
        $status = $user->fill($data)->save();
        if ($status) {
            request()->session()->flash('success', 'Cập nhật mật khẩu thành công.');
            return redirect()->route('dashboard.profile');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('dashboard.profile.show-update-password');
    }

    public function updateAvatar(Request $request)
    {
        $messages = [
            'avatar.required' => 'Ảnh đại diện không được bỏ trống',
            'avatar.string' => 'Ảnh đại diện phải là chuỗi'
        ];

        $this->validate(
            $request,
            [
                'avatar' => 'required|string',
            ],
            $messages
        );

        $user = User::find(Auth::id());

        $data = $request->all();

        $status = $user->fill($data)->save();

        if ($status) {
            request()->session()->flash('success', 'Cập nhật ảnh đại diện thành công.');
        } else {
            request()->session()->flash('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
        return redirect()->route('dashboard.profile');
    }
}
