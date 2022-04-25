@extends('dashboard.layouts.app')
@section('title', 'Tạo Lịch Chiếu')

@php
$breadcrumbs = [
[
'name' => 'Danh sách lịch chiếu',
'url' => route('show.index'),
'active' => false,
],
[
'name' => 'Tạo lịch chiếu',
'url' => route('show.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Lịch Chiếu" route="show.store">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ old('name') }}" />

    <x-Dashboard.Forms.Select name="Phòng Chiếu" property="room_id">
      @foreach ($rooms as $room)
      <option value="{{ $room->room_id }}" {{ $room->room_id === old('room_id') ? 'selected' : '' }}>{{ $room->name }}</option>
      @endforeach
    </x-Dashboard.Forms.Select>

    <x-Dashboard.Forms.Input name="Giờ" property="time_start" type="text" placeholder="H:MM P" value="{{ old('time_start') }}" />
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection

@push('scripts')
<script>
  const selectMovieIdField = d.querySelector('#inputMovie_id');
  if(selectMovieIdField) {
    const choices = new Choices(selectMovieIdField); 
  }

  const selectRoomIdField = d.querySelector('#inputRoom_id');
  if(selectRoomIdField) {
    const choices = new Choices(selectRoomIdField); 
  }

  $('#inputTime_start').timepicker({
    timeFormat: 'h:mm p',
    dropdown: true,
    scrollbar: true
});
</script>
@endpush