@extends('shop.layouts.app')
@section('title', 'Liên hệ')

@section('content')
    <section class="ftco-section">
        <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/breadcrumb.jpeg') }}');">
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center">
                    <div class="col-md-9 ftco-animate text-center">
                        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('shop.home') }}">Trang
                                    Chủ</a></span>
                            <span>Liên Hệ</span>
                        </p>
                        <h1 class="mb-0 bread">Liên Hệ Với Chúng Tôi</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="w-100"></div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Địa chỉ:</span>180 Cao Lỗ, Phường 4, Quận 8, TP. Hồ Chí Minh</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Số điện thoại:</span> <a href="tel://0901234567">0901234567</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Email:</span> <a href="mailto:stu@gmail.com">stu@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Địa chỉ website:</span> <a href="{{ route('shop.home') }}">stu.edu.vn</a></p>
                    </div>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <form action="#" class="bg-white p-5 contact-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nhập họ tên">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nhập email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group">
                            <textarea name="" id="" cols="30" rows="7" class="form-control"
                                placeholder="Nội dung"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Gửi" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>

                </div>

                <div class="col-md-6 d-flex">
                    <div id="map" class="bg-white"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
