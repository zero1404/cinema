@extends('dashboard.layouts.app')
@section('title', 'Sửa Phòng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phòng',
'url' => route('room.index'),
'active' => false,
],
[
'name' => 'Sửa phòng',
'url' => route('room.edit', $room->room_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Phòng" route="room.update" :id="$room->room_id">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ $room->name }}" />
 
      <x-Dashboard.Forms.Select name="Loại ghế" property="seat_id">
        @foreach ($seats as $seat)
        <option value="{{ $seat->seat_id }}" {{ $seat->seat_id === $room->seat->seat_id ? 'selected' : '' }}>{{ $seat->name }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
  
      <x-Dashboard.Forms.Input name="Số ghế" property="total_seat" type="number" placeholder="Nhập số ghế" value="{{ $room->total_seat }}" />
    </x-Dashboard.Forms.FormEdit>
</div>
@endsection