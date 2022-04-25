@extends('dashboard.layouts.app')
@section('title', 'Thông tin tài khoản')

@php
$breadcrumbs = [
[
'name' => 'Thông tin tài khoản',
'url' => route('dashboard.profile'),
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
  <div class="col-12 col-xl-8">
    <div class="card card-body border-0 shadow mb-4">
      <h2 class="h5 mb-4">Thông tin chung</h2>
      <form method="post" action="">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <x-Dashboard.Forms.Input name="Họ" property="lastname" placeholder="Nhập họ"
              value="{{ auth()->user()->lastname }}" />
          </div>

          <div class="col-md-6">
            <x-Dashboard.Forms.Input name="Tên" property="firstname" placeholder="Nhập tên"
              value="{{ auth()->user()->firstname }}" />
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-6">
            <x-Dashboard.Forms.InputDate name="Ngày sinh" property="birthday"
              value="{{ Helpers::formatDate(auth()->user()->birthday) }}" />
          </div>
          <div class="col-md-6">
            <x-Dashboard.Forms.Select name="Giới tính" property="gender">
              <option value="male" {{ auth()->user()->gender ? 'selected' : ''}}>Nam</option>
              <option value="female" {{ !auth()->user()->gender ? 'selected' : ''}}>Nữ</option>
            </x-Dashboard.Forms.Select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <x-Dashboard.Forms.Input name="Email" type="email" property="email" placeholder="Nhập email"
              value="{{ auth()->user()->email }}" />
          </div>
          <div class="col-md-6">
            <x-Dashboard.Forms.Input name="Số điện thoại" type="phone" property="telephone"
              placeholder="Nhập số điện thoại" value="{{ auth()->user()->telephone }}" />
          </div>
        </div>
        <h2 class="h5 my-3">Địa chỉ</h2>
        <div class="row">
          <div class="col-sm-12">
            <x-Dashboard.Forms.Input name="Địa chỉ" property="address" type="text" placeholder="Nhập địa chỉ"
              value="{{ auth()->user()->address ? auth()->user()->address->address : '' }}" />
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <x-Dashboard.Forms.Select name="Tỉnh" property="province">
              @foreach (Helpers::getAllProvince() as $province)
              <option value="{{ $province->id }}" {{ auth()->user()->address && auth()->user()->address->province->id ==
                $province->id ? '
                selected' : '' }}>
                {{ $province->name_with_type }}</option>
              @endforeach
            </x-Dashboard.Forms.Select>
          </div>
          <div class="col-sm-4">
            <x-Dashboard.Forms.Select name="Thành phố/quận" property="district">
              @if (auth()->user()->address)
              @foreach (Helpers::getDistricts(auth()->user()->address->province->id) as $district)
              <option value="{{ $district->id }}" {{ $district->id == auth()->user()->address->district->id ? '
                selected' : '' }}>
                {{ $district->name_with_type }}</option>
              @endforeach
              @endif
            </x-Dashboard.Forms.Select>
          </div>
          <div class="col-sm-4">
            <x-Dashboard.Forms.Select name="Phường/Xã" property="ward">
              @if (auth()->user()->address)
              @foreach (Helpers::getWards(auth()->user()->address->district->id) as $ward)
              <option value="{{ $ward->id }}" {{ $ward->id == auth()->user()->address->ward->id ? ' selected' : '' }}>
                {{ $ward->name_with_type }}</option>
              @endforeach
              @endif
            </x-Dashboard.Forms.Select>
          </div>
        </div>
        <div class="mt-3">
          <button class="btn btn-gray-800 mt-2 animate-up-2" type="submit">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-12 col-xl-4">
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card shadow border-0 text-center p-0">
          <div class="profile-cover rounded-top" data-background="{{asset('admin/img/profile-cover.jpg')}}"></div>
          <div class="card-body pb-5">
            <img src="{{Helpers::getUserAvatar(auth()->user()->avatar)}}"
              class="avatar-xl rounded-circle mx-auto mt-n7 mb-4" alt="Neil Portrait">
            <h4 class="h3">{{ auth()->user()->fullname }}</h4>
            <h5 class="fw-normal">{{ auth()->user()->email }}</h5>
            <p class="text-gray mb-4">{{ auth()->user()->birthday ? auth()->user()->birthday : 'dd/MM/yyyy' }} - {{
              auth()->user()->gender ? 'Nam' : 'Nữ' }}</p>
            <a href="{{ route('dashboard.profile.show-update-password') }}"
              class="btn btn-sm btn-secondary text-white">Đổi
              Mật Khẩu</a>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card card-body border-0 shadow mb-4">
          <form method="POST" action="{{ route('dashboard.profile.update-avatar') }}">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="h5 mb-4">Chọn ảnh đại diện</h2>
              <button type="submit" class="btn btm-sm btn-success text-white mb-4" id="btnUpdateAvatar" disabled>Cập
                nhật</button>
            </div>
            <div class="d-flex align-items-center">
              <div class="me-3">
                <!-- Avatar -->
                <img class="rounded avatar-xl" src="{{Helpers::getUserAvatar(auth()->user()->avatar)}}"
                  alt="change avatar" id="imgAvatar">
              </div>
              <div class="file-field">
                <div class="d-flex flex-row justify-content-xl-center ms-xl-3">
                  @csrf
                  <x-Dashboard.Forms.InputImage name="Ảnh đại diện" property="avatar" :value="auth()->user()->avatar" />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  let originAvatar = $('#inputAvatar').val();

  $('#lfm').filemanager('image');

  $('#inputAvatar').change(function() {
    const src = $(this).val();
    const isDisabled = originAvatar === src;
    $('#btnUpdateAvatar').prop('disabled', isDisabled);
    $('#imgAvatar').attr("src", src);
  });

</script>
@endpush