@extends('shop.layouts.app')
@section('title', 'Giỏ Hàng')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/breadcrumb.jpeg') }}');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('shop.home') }}">Trang
                            Chủ</a></span>
                    <span>Giỏ Hàng</span>
                </p>
                <h1 class="mb-0 bread">Giỏ Hàng</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    @if (!$carts || $carts->count == 0)
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="card">
                    <div class="card-header cart-empty">
                        <h5 class="my-auto"><span class="icon-shopping-cart mr-1"></span> Giỏ hàng</h5>
                    </div>
                    <div class="card-body cart">
                        <div class="col-sm-12 text-center"> <img src="{{ asset('shop/images/empty-cart.png') }}"
                                width="130" height="130" class="img-fluid mb-4 mr-3">
                            <h3>
                                Giỏ hàng của bạn còn trống
                            </h3>
                            <a href="{{ route('shop.product-list') }}" class="btn btn-primary btn-lg m-3">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <x-Shop.Cart.CartList :carts="$carts" />
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Mã giảm giá</h3>
                    <p>Nhập mã giảm giá nều bạn có</p>
                    <form action="{{ route('shop.apply-coupon') }}" method="post" class="info form-inline">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="coupon-input" class='mr-3'>Mã giảm giá:</label>
                            <input id='coupon-input' type="text" name='code' class="form-control text-left px-3"
                                value="{{ session('coupon') ? session('coupon')['code'] : '' }}">
                            <button class="btn btn-black py-3 px-4 ml-4" style='color: #fff !important'>Áp
                                dụng</button>
                        </div>
                    </form>
                    @if (session('error-coupon'))
                    <span id='coupon-msg' class="d-block text-danger mt-1">{{ session('error-coupon') }}</span>
                    @elseif(session('success-coupon'))
                    <span id='coupon-msg' class="d-block text-success mt-1">{{ session('success-coupon') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Tổng Giỏ Hàng</h3>
                    <p class="d-flex">
                        <span>Tổng tiền hàng</span>
                        <span id="subtotal">{{ Helpers::formatCurrency($carts->total) }}</span>
                    </p>
                    {{-- <p class="d-flex">
                        <span>Phí vận chuyển</span>
                        <span>0 VNĐ</span>
                    </p> --}}
                    <p class="d-flex">
                        <span>Giảm giá</span>
                        <span id='discount-price'>
                            {{ Helpers::formatCurrency($discount_money) }}
                        </span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Tổng số tiền</span>
                        <span id="total-price">{{ Helpers::formatCurrency($carts->total - $discount_money) }}</span>
                    </p>
                </div>
                <p><a href="{{ route('shop.checkout') }}" class="btn btn-primary py-3 px-4">Thanh Toán</a></p>
            </div>
        </div>
    </div>
    @endif

    @if (!$carts || $carts->count == 0)
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Có thể bạn thích</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach (Helpers::getRandomProduct() as $product)
                <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    @endif
</section>
@endsection