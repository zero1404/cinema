@extends('dashboard.layouts.app')
@section('title', 'Tạo Diễn Viên')

@php
$breadcrumbs = [
[
'name' => 'Danh sách diễn viên',
'url' => route('actor.index'),
'active' => false,
],
[
'name' => 'Tạo diễn viên',
'url' => route('actor.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Diễn Viên" route="actor.store">
    <x-Dashboard.Forms.Input name="Họ" property="last_name" type="text" placeholder="Nhập họ" value="{{ old('last_name') }}" />
    <x-Dashboard.Forms.Input name="Tên" property="first_name" type="text" placeholder="Nhập tên" value="{{ old('first_name') }}" />
    <x-Dashboard.Forms.InputImage name="Ảnh đại diện" property="avatar" :value="old('avatar')" />
    <x-Dashboard.Forms.Textarea name="Mô tả" property="description" value="{{ old('description') }}"
      placeholder="Nhập mô tả" rows="5" />
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection