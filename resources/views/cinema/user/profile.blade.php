@extends('cinema.layouts.app')
@section('title', 'Thông tin tài khoản')

@section('content')
<div class="container my-4 padding-top">
    <div class="row">
        <div class="col-md-3 ">
            <div class="card mb-3" style="background: transparent !important">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <form method="post" action="{{ route('cinema.profile.update-avatar.handle') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label for="inputAvatar">
                                <img id="imgReview" src="{{ Helpers::getUserAvatar(Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" width="150">
                            </label>
                            <input id="inputAvatar" type="file" name="avatar" style="display: none"
                                oninput="imgReview.src=window.URL.createObjectURL(this.files[0])" />
                            <div class="mt-3">
                                <h4></h4>
                                <p class="text-muted font-size-sm"></p>
                                <button id='btn-avatar' class="custom-button back-button" type="submit" disabled>Đổi Ảnh
                                    Đại Diện</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="list-group list-menu">
                @if (Auth::user()->role == 'admin')
                <a href="{{ route('dashboard.index') }}" class="list-group-item list-group-item-action">Dashboard</a>
                @endif
                <a href="{{ route('cinema.booking.list') }}" class="list-group-item list-group-item-action">Đơn đặt
                    hàng</a>
                <a href="{{ route('cinema.profile') }}" class="list-group-item list-group-item-action">Thông tin tài
                    khoản</a>
                <a href="{{ route('cinema.profile.change-password') }}" class="list-group-item list-group-item-action">Đổi
                    mật khẩu</a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row p-3">
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
                        <div class="col-md-12 mb-4">
                            <h5>Thông Tin Tài Khoản</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('cinema.profile.update.handle') }}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Họ</label>
                                    <div class="col-8">
                                        <input id="lastname" name="lastname" placeholder="Họ"
                                            type="text" value="{{ Auth::user()->last_name }}">
                                        @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-4 col-form-label">Tên</label>
                                    <div class="col-8">
                                        <input id="firstname" name="firstname" placeholder="Tên"
                                   type="text" value="{{ Auth::user()->first_name }}">
                                        @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email" placeholder="Nhập email"
                                       required="required" type="email"
                                            value="{{ Auth::user()->email }}">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telephone" class="col-4 col-form-label">Số điện thoại</label>
                                    <div class="col-8">
                                        <input id="telephone" name="telephone" placeholder="Nhập số điện thoại"
                                          required="required" type="text"
                                            value="{{ Auth::user()->telephone }}">
                                        @error('telephone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div lass="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="custom-button back-button">Cập
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