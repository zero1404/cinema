@extends('dashboard.layouts.app')
@section('title', 'Sửa Tài Khoản')

@php
$breadcrumbs = [
[
'name' => 'Danh sách tài khoản',
'url' => route('user.index'),
'active' => false
],
[
'name' => 'Tạo tài khoản',
'url' => route('user.edit', $user->user_id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />

  <x-Dashboard.Forms.FormEdit name="Tài Khoản" route="user.update" :id="$user->user_id">
    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Họ" property="last_name" type="text" placeholder="Nhập họ" value="{{ $user->last_name }}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Tên" property="first_name" type="text" placeholder="Nhập tên"
          value="{{ $user->first_name }}" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Email" property="email" type="email" placeholder="Nhập email"
          value="{{ $user->email }}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Điện Thoại" property="telephone" type="tel" placeholder="Nhập số điện thoại"
          value="{{ $user->telephone }}" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.InputDate name="Ngày sinh" property="birthday"
          value="{{ $user->birthday && Helpers::formatDate($user->birthday)}}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Select name="Giới tính" property="gender">
          <option value="male" {{ $user->gender=='male' ? 'selected' : '' }}>Nam</option>
          <option value="female" {{ $user->gender=='female' ? 'selected' : '' }}>Nữ</option>
        </x-Dashboard.Forms.Select>
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

    <x-Dashboard.Forms.InputImage name="Ảnh đại diện" property="avatar" :value="$user->avatar" />

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Chức vụ" property="role">
          <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Admin</option>
          <option value="customer" {{ $user->role == 'customer' ? 'selected' : ''}}>Khách hàng</option>
        </x-Dashboard.Forms.Select>
      </div>
      <div class="col">
        <x-Dashboard.Forms.Select name="Trạng thái" property="status">
          <option value="active" {{ $user->status=='active' ? 'selected' : '' }}>Hoạt động</option>
          <option value="inactive" {{ $user->status=='inactive' ? 'selected' : '' }}>Không hoạt động</option>
        </x-Dashboard.Forms.Select>
      </div>
    </div>
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  $('#lfm').filemanager('image');
</script>
@endpush