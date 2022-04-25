@extends('dashboard.layouts.app')
@section('title', 'Thông tin tài khoản')

@php
$breadcrumbs = [
[
'name' => 'Thông tin tài khoản',
'url' => route('dashboard.profile'),
'active' => false,
],
[
'name' => 'Đổi Mật Khẩu',
'url' => route('dashboard.profile.show-update-password'),
'active' => true,
]
]
@endphp

@section('content')
<div class="pt-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
</div>
<x-Dashboard.Shared.FlashMessage />

<div class="row">
  <div class="col-md-12">
    <div class="card card-body border-0 shadow mb-4">
      <h2 class="h5 mb-2">{{ __('Đổi Mật Khẩu')}}</h2>
      <form action="{{ route('dashboard.profile.update-password')}}" method="post">
        @csrf
        <!-- Form -->
        @csrf
        <x-Dashboard.Forms.Input name="Mật khẩu hiện tại" property="oldpassword" type="password"
          placeholder="Nhập mật khẩu hiện tại" value="" />

        <x-Dashboard.Forms.Input name="Mật khẩu mới" property="password" type="password" placeholder="Nhập mật khẩu"
          value="" />
        <x-Dashboard.Forms.Input name="Xác nhận mật khẩu" property="repassword" type="password"
          placeholder="Nhập lại mật khẩu" value="" />
        <!-- End of Form -->
        <button type="submit" class="btn btn-success text-white" id="btnChangePassword">Cập nhật</button>
      </form>
    </div>
  </div>

</div>
@endsection