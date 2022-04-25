@extends('shop.layouts.app')
@section('title', 'Danh Sách Đơn Đặt Hàng')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/breadcrumb.jpeg') }}');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('shop.home') }}">Trang
                            Chủ</a></span>
                    <span>Đơn Đặt Hàng</span>
                </p>
                <h1 class="mb-0 bread">Đơn Đặt Hàng</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    @if (!$orders || count($orders) == 0)
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="card">
                    <div class="card-header cart-empty">
                        <h5 class="my-auto"><span class="icon-shopping-cart mr-1"></span> Đơn Đặt Hàng</h5>
                    </div>
                    <div class="card-body cart">
                        <div class="col-sm-12 text-center"> <img src="{{ asset('shop/images/empty-cart.png') }}"
                                width="130" height="130" class="img-fluid mb-4 mr-3">
                            <h3>
                                Bạn chưa đặt đơn hàng nào
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
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Mã</th>
                                <th>Ngày tạo đơn</th>
                                <th>Tổng</th>
                                <th>Trạng Thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td></td>
                                <td> {{ $order->order_number }}</td>
                                <td> {{ $order->created_at->format('d/m/Y') }}</td>
                                <td>
                                    {{ Helpers::formatCurrency($order->total) }}
                                </td>
                                <td>
                                    {!! Helpers::displayStatusOrder($order->status) !!}
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('shop.detail-ordered', $order->id) }}">Xem chi
                                        tiết</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links('shop.layouts.pagination') }}
                </div>

            </div>
        </div>
    </div>
    @endif

    @if (!$orders || count($orders) == 0)
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