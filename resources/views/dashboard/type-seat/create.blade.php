@extends('dashboard.layouts.app')
@section('title', 'Tạo Loại Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách loại ghế',
'url' => route('type-seat.index'),
'active' => false,
],
[
'name' => 'Tạo loại ghế',
'url' => route('type-seat.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Ghế" route="type-seat.store">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ old('name') }}" />
    <x-Dashboard.Forms.Input name="Giá" property="price" type="text" placeholder="Nhập giá" value="{{ old('price') }}" />
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection