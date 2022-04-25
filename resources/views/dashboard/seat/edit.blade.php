@extends('dashboard.layouts.app')
@section('title', 'Sửa Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ghế',
'url' => route('seat.index'),
'active' => false,
],
[
'name' => 'Sửa ghế',
'url' => route('seat.edit', $seat->seat_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Ghế" route="seat.update" :id="$seat->seat_id">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ $seat->name }}" />
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection