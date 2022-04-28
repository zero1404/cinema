@extends('dashboard.layouts.app')
@section('title', 'Sửa Loại Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách loại ghế',
'url' => route('type-seat.index'),
'active' => false,
],
[
'name' => 'Sửa loại ghế',
'url' => route('type-seat.edit', $type_seat->type_seat_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Ghế" route="type-seat.update" :id="$type_seat->type_seat_id">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ $type_seat->name }}" />
      <x-Dashboard.Forms.Input name="Giá" property="price" type="text" placeholder="Nhập giá" value="{{ $type_seat->price }}" />
    </x-Dashboard.Forms.FormEdit>
</div>
@endsection