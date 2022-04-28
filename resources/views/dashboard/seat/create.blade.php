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
   
    <x-Dashboard.Forms.Select name="Phòng" property="room_id">
      @foreach ($rooms as $room)
      <option value="{{ $room->room_id }}" {{ $room->room_id === old('room_id') ? 'selected' : ''}}>{{ $room->name }}</option>
      @endforeach
    </x-Dashboard.Forms.Select>

    <x-Dashboard.Forms.Select name="Loại ghế" property="type_seat_id">
      @foreach ($type_seats as $type_seat)
      <option value="{{ $type_seat->type_seat_id }}" {{ $type_seat->type_seat_id === old('type_seat_id') ? 'selected' : ''}}>{{ $type_seat->name }}</option>
      @endforeach
    </x-Dashboard.Forms.Select>
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection

@push('scripts')
<script>
  const selectRoomIdField = document.getElementById('inputRoom_id');
  if(selectRoomIdField) {
    const choices = new Choices(selectRoomIdField); 
  }

</script>
@endpush