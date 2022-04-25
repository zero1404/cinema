<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Helpers;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getListCart()
    {
        $carts = Cart::getCart();
        $user = Auth::user();

        if (session('coupon')) {
            $coupon = Coupon::find(session('coupon')['id'])->first();
            if (!Helpers::isValidCoupon($coupon)) {
                session()->forget('coupon');
            }
        }

        $discount_money = Helpers::getDiscountMoney($carts->total ?? 0);
        return view('shop.user.cart', compact('carts', 'user', 'discount_money'));
    }

    public function addToCart(Request $request, $id)
    {
        if ($request->ajax()) {

            $carts = Cart::getCart();
            $product = Product::findOrFail($id);

            if ($product == null) {
                return response()->json(['message' => 'Không tìm thấy sản phẩm', 'type' => 'product-not-found'], 400);
            }

            if ($request->quantity > $product->quantity) {
                return response()->json(['message' => 'Số lượng đặt hàng không được lớn hơn số lượng trong kho', 'type' => 'quantity'], 400);
            }

            if ($carts) {
                $item = CartItem::where('cart_id', $carts->id)->where('product_id', $product->id)->first();
                if ($item) {
                    $item->quantity += $request->quantity;
                    $item->update();
                    return response()->json(['message' => 'Thêm vào giỏ hàng thành công', 'count' => $carts->count, 'isUpdate' => false], 200);
                } else {
                    $cart_item = new CartItem();
                    $cart_item->cart_id = $carts->id;
                    $cart_item->product_id = $product->id;
                    $cart_item->quantity = $request->quantity;
                    $cart_item->save();
                    return response()->json(['message' => 'Thêm vào giỏ hàng thành công', 'count' => $carts->count, 'isUpdate' => true], 200);
                }
            } else {
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->total = 0;
                $cart->status = 'active';
                $cart->save();

                $cart_item = new CartItem();
                $cart_item->cart_id = $cart->id;
                $cart_item->product_id = $product->id;
                $cart_item->quantity = $request->quantity;
                $cart_item->save();
                return response()->json(['message' => 'Thêm vào giỏ hàng thành công', 'count' => $cart->count, 'isUpdate' => true], 200);
            }
        } else return response()->json(['message' => 'Có lỗi xảy ra', 'type' => 'request'], 400);
    }

    public function updateCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = CartItem::findOrFail($id);

            if (!$item) {
                return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
            }

            if ($request->quantity > $item->product->quantity) {
                return response()->json(['message' => 'Số lượng đặt hàng không được lớn hơn số lượng trong kho', 'type' => 'quantity'], 400);
            }

            $item->quantity = $request->quantity;
            $status = $item->save();

            if ($status) {
                $carts = Cart::getCart();
                $total_item = $item->quantity * $item->product->price;
                $discount_money = Helpers::getDiscountMoney($carts->total);
                return response()->json(['message' => 'Cập nhập giỏ hàng thành công', 'count' => $carts->count, 'total_item' => $total_item, 'discount_money' => $discount_money, 'total' => $carts->total], 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
            }
        } else return response()->json(['message' => 'Có lỗi xảy ra', 'type' => 'request'], 400);
    }

    public function removeCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = CartItem::find($id);

            if ($item == null) {
                return response()->json(['message' => 'Không tìm thấy sản phẩm', 'type' => 'item-not-found'], 400);
            }

            $status = $item->delete();

            if ($status) {
                $carts = Cart::getCart();

                if ($carts->total == 0) {
                    $discount_money = 0;
                } else {
                    $discount_money = Helpers::getDiscountMoney($carts->total);
                }

                return response()->json(['message' => 'Xoá sản phẩm khỏi giỏ hàng thành công', 'discount_money' => $discount_money, 'total' => $carts->total], 200);
            } else {
                return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
            }
        } else return response()->json(['message' => 'Có lỗi xảy ra', 'type' => 'request'], 400);
    }
}
