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
  
      <x-Dashboard.Forms.Select name="Phòng" property="room_id">
        @foreach ($rooms as $room)
        <option value="{{ $room->room_id }}" {{ $room->room_id === $seat->room->room_id ? 'selected' : ''}}>{{ $room->name }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
  
      <x-Dashboard.Forms.Select name="Loại ghế" property="type_seat_id">
        @foreach ($type_seats as $type_seat)
        <option value="{{ $type_seat->type_seat_id }}" {{ $type_seat->type_seat_id === $seat->typeSeat->type_seat_id ? 'selected' : ''}}>{{ $type_seat->name }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
    </x-Dashboard.Forms.FormEdit>
</div>
@endsection