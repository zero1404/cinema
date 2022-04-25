@extends('shop.layouts.app')
@section('title', 'Đặt hàng thành công')

@section('content')
<section class="shoping-cart spad ">
    <div class="d-md-flex align-items-md-center height-100vh--md">
        <div class="container text-center space-2 space-3--lg">
            <div class="w-md-80 w-lg-60 text-center mx-md-auto py-4 my-5">
                <div class="mb-5">
                    <span class="u-icon u-icon--secondary mb-4">
                        <span class="icon-check u-icon__inner"></span>
                    </span>
                    <h1 class="h2">Đặt Hàng Thành Công</h1>
                    <p>Chúng tôi sẽ giao hàng cho bạn sớm nhất có thể.</p>
                </div>
                <a class="btn btn-primary btn-lg" href="{{ route('shop.list-ordered') }}">Xem danh sách đơn hàng</a>
            </div>
        </div>
    </div>
</section>
@endsection