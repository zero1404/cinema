<div class="cart-list">
    <table class="table">
        <thead class="thead-primary">
            <tr class="text-center">
                <th>&nbsp;</th>
                <th>Hình Ảnh</th>
                <th>Sản Phẩm</th>
                <th>Giá Bán</th>
                <th>Số Lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts->items as $cart)
                <x-Shop.Cart.CartItem :item="$cart" />
            @endforeach
        </tbody>
    </table>
</div>
