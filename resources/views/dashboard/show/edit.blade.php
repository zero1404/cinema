@extends('dashboard.layouts.app')
@section('title', 'Sửa Phòng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách lịch chiếu',
'url' => route('show.index'),
'active' => false,
],
[
'name' => 'Sửa lịch chiếu',
'url' => route('show.edit', $show->show_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Lịch Chiếu -  {{$show->movie->title}}" route="show.update" :id="$show->show_id">
    <input type="hidden" name="movie_id" value="{{$show->movie->movie_id}}" />
   
    <div class="row">
     <div class="col">
      <x-Dashboard.Forms.Select name="Phòng Chiếu" property="room_id">
        @foreach ($rooms as $room)
        <option value="{{ $room->room_id }}" {{ $room->room_id === $show->room->room_id ? 'selected' : '' }}>{{ $room->name }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
     </div>

     <div class="col">
      <x-Dashboard.Forms.Select name="Khung Giờ" property="time_slot_id">
        @foreach ($time_slots as $time_slot)
        <option value="{{ $time_slot->time_slot_id }}" {{  $time_slot->time_slot_id === $show->timeSlot->time_slot_id ? 'selected' : '' }}>{{ $time_slot->time_start .' - '. $time_slot->time_end }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
     </div>
   </div>
   
    <x-Dashboard.Forms.Select name="Trạng thái" property="status">
      <option value="active" {{ $show->status == 'active' ? 'selected' : '' }}>Đang chiếu</option>
      <option value="inactive" {{ $show->status == 'inactive' ? 'selected' : '' }}>Dừng chiếu</option>
    </x-Dashboard.Forms.Select>
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection