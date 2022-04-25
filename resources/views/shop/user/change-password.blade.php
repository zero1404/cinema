@extends('shop.layouts.app')
@section('title', 'Thông tin tài khoản')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-3 ">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <form method="post" action="{{ route('shop.update-profile-avatar') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <label for="inputAvatar">
                                    <img id="imgReview" src="  @if (File::exists(Auth::user()->avatar))
                                    {{ asset(Auth::user()->avatar) }}
                                @else
                                    {{ Auth::user()->avatar }}
                                    @endif" alt="Avatar"
                                    class="rounded-circle" width="150">
                                </label>
                                <input id="inputAvatar" type="file" name="avatar" style="display: none"
                                    oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" />
                                <div class="mt-3">
                                    <h4></h4>
                                    <p class="text-muted font-size-sm"></p>
                                    <button id='btn-avatar' class="btn btn-outline-success" type="submit" disabled>Đổi Ảnh
                                        Đại Diện</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="list-group ">
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action">Dashboard</a>
                    @endif
                    <a href="{{ route('shop.list-ordered') }}" class="list-group-item list-group-item-action">Đơn đặt hàng</a>
                    <a href="{{ route('shop.cart') }}" class="list-group-item list-group-item-action">Giỏ hàng</a>
                    <a href="{{ route('shop.profile') }}" class="list-group-item list-group-item-action">Thông tin tài
                        khoản</a>
                    <a href="{{ route('shop.change-password-profile') }}" class="list-group-item list-group-item-action">Đổi
                        mật khẩu</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @error('avatar')
                                <div class="col-lg-12 mx-auto">
                                    <div class="alert alert-danger alert-dismissable fade show">
                                        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                                        {{ $message }}
                                    </div>
                                </div>
                            @enderror
                            @if (session('success'))
                                <div class="col-lg-12 mx-auto">
                                    <div class="alert alert-success alert-dismissable fade show">
                                        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                                        {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="col-lg-12 mx-auto">
                                    <div class="alert alert-danger alert-dismissable fade show">
                                        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                                        {{ session('error') }}
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <h4 style='color: #000!important'>Đổi Mật Khẩu</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('shop.update-profile-password') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label for="name" class="col-4 col-form-label">Họ</label>
                                        <div class="col-8">
                                            <input id="oldpassword" name="oldpassword" placeholder="Nhập mật khẩu hiện tại"
                                                class="form-control here" type="password">
                                            @error('oldpassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-4 col-form-label">Tên</label>
                                        <div class="col-8">
                                            <input id="password" name="password" placeholder="Nhập mật khẩu mới"
                                                class="form-control here" type="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-4 col-form-label">Email</label>
                                        <div class="col-8">
                                            <input id="repassword" name="repassword" placeholder="Nhập lại mật khẩu"
                                                class="form-control here" required="required" type="password">
                                            @error('repassword')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-4 col-8">
                                            <button name="submit" type="submit" class="btn btn-primary px-4 py-2">Cập
                                                Nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
