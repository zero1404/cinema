@extends('dashboard.layouts.app')
@section('title', 'Tạo Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ghế',
'url' => route('seat.index'),
'active' => false,
],
[
'name' => 'Tạo ghế',
'url' => route('seat.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Ghế" route="seat.store">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ old('name') }}" />
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection