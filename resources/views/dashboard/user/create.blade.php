@extends('dashboard.layouts.app')
@section('title', 'Tạo Tài Khoản')

@php
$breadcrumbs = [
[
'name' => 'Danh sách tài khoản',
'url' => route('user.index'),
'active' => false
],
[
'name' => 'Tạo tài khoản',
'url' => route('user.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
    <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
    <x-Dashboard.Forms.FormCreate name="Tài Khoản" route="user.store">
        <div class="row">
            <div class="col">
                <x-Dashboard.Forms.Input name="Họ" property="last_name" type="text" placeholder="Nhập họ"
                    value="{{ old('last_name') }}" />
            </div>
            <div class="col">
                <x-Dashboard.Forms.Input name="Tên" property="first_name" type="text" placeholder="Nhập tên"
                    value="{{ old('first_name') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Dashboard.Forms.Input name="Email" property="email" type="email" placeholder="Nhập email"
                    value="{{ old('email') }}" />
            </div>
            <div class="col">
                <x-Dashboard.Forms.Input name="Điện Thoại" property="telephone" type="tel" placeholder="Nhập số điện thoại"
                    value="{{ old('telephone') }}" />
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Dashboard.Forms.Input name="Mật khẩu" property="password" type="password" placeholder="Nhập mật khẩu"
                    value="" />
            </div>
            <div class="col">
                <x-Dashboard.Forms.Input name="Xác nhận mật khẩu" property="repassword" type="password"
                    placeholder="Nhập lại mật khẩu" value="" />
            </div>
        </div>

        <div class="row">
            <div class="col">
                <x-Dashboard.Forms.InputDate name="Ngày sinh" property="birthday" value="" />
            </div>
            <div class="col">
                <x-Dashboard.Forms.Select name="Giới tính" property="gender">
                    <option value="male" {{ old('gender')=='male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ old('gender')=='female' ? 'selected' : '' }}>Nữ</option>
                </x-Dashboard.Forms.Select>
            </div>
        </div>

        <x-Dashboard.Forms.InputImage name="Ảnh đại diện" property="avatar" :value="old('avatar')" />

        <div class="row">
            <div class="col">
                <x-Dashboard.Forms.Select name="Chức vụ" property="role">
                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ old('role')=='customer' ? 'selected' : '' }}>Khách hàng</option>
                </x-Dashboard.Forms.Select>
            </div>
            <div class="col">
                <x-Dashboard.Forms.Select name="Trạng thái" property="status">
                    <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status')=='active' ? 'selected' : '' }}>Không hoạt động</option>
                </x-Dashboard.Forms.Select>
            </div>
        </div>
    </x-Dashboard.Forms.FormCreate>
</div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush