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
                                <img id="imgReview" src="      @if (File::exists($user->avatar))
                                    {{ asset($user->avatar) }}
                                @else
                                    {{ $user->avatar }}
                                    @endif" alt="Avatar" class="rounded-circle" width="150">
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
                <a href="{{ route('shop.list-ordered') }}" class="list-group-item list-group-item-action">Đơn đặt
                    hàng</a>
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
                        <div class="col-md-12 mb-4">
                            <h4 style='color: #000!important'>Thông Tin Tài Khoản</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('shop.update-profile') }}">
                                {{ csrf_field() }}
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Họ</label>
                                    <div class="col-8">
                                        <input id="lastname" name="lastname" placeholder="Họ" class="form-control here"
                                            type="text" value="{{ Auth::user()->lastname }}">
                                        @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-4 col-form-label">Tên</label>
                                    <div class="col-8">
                                        <input id="firstname" name="firstname" placeholder="Tên"
                                            class="form-control here" type="text" value="{{ Auth::user()->firstname }}">
                                        @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email" placeholder="Nhập email"
                                            class="form-control here" required="required" type="email"
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
                                            class="form-control here" required="required" type="text"
                                            value="{{ Auth::user()->telephone }}">
                                        @error('telephone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAddress" class="col-4 col-form-label">Địa chỉ</label>
                                    <div class="col-8">
                                        <input id="inputAddress" name="address" placeholder="Nhập địa chỉ"
                                            class="form-control here" required="required" type="text"
                                            value="{{ auth()->user()->address ? auth()->user()->address->address : '' }}">
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="province" class="col-4 col-form-label">Tỉnh:</label>
                                    <div class="col-8">
                                        <select name="province" id="province" class="form-control w-100">
                                            <option value="">Chọn tỉnh</option>
                                            @foreach (Helpers::getAllProvince() as $province)
                                            <option value="{{ $province->id }}" {{ auth()->user()->address &&
                                                auth()->user()->address->province->id ==
                                                $province->id ? '
                                                selected' : '' }}>
                                                {{ $province->name_with_type }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label or="district" class="col-4 col-form-label">Thành phố/quận:</label>
                                    <div class="col-8">
                                        <select name="district" id="district" class="form-control w-100">
                                            <option value="">Chọn thành phố/quận</option>
                                            @if (Auth::user()->address)
                                            @foreach (Helpers::getDistricts(Auth::user()->address->province->id) as
                                            $district)
                                            <option value="{{ $district->id }}" {{ $district->id ==
                                                Auth::user()->address->district->id ? ' selected="selected"' : '' }}>
                                                {{ $district->name_with_type }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ward" class="col-4 col-form-label">Phường/Xã:</label>
                                    <div class="col-8">
                                        <select name="ward" id="ward" class="form-control w-100">
                                            <option value="">Chọn phường/xã: </option>
                                            @if (Auth::user()->address)
                                            @foreach (Helpers::getWards(Auth::user()->address->district->id) as $ward)
                                            <option value="{{ $ward->id }}" {{ $ward->id ==
                                                Auth::user()->address->ward->id ? ' selected' : '' }}>
                                                {{ $ward->name_with_type }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @error('ward')
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