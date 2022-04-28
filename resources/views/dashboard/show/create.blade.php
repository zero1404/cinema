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
'url' => route('show.create.movie', $movie->movie_id),
'active' => true,
]
];

$columns = [
'id' => 'ID',
'time_start' => 'Khung Giờ',
'room' => 'Phòng Chiếu',
'action' => '',
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Lịch Chiếu -  {{$movie->title}}" route="show.store">
    <input type="hidden" name="movie_id" value="{{$movie->movie_id}}" />
   <div class="row">
     <div class="col">
      <x-Dashboard.Forms.Select name="Phòng Chiếu" property="room_id">
        @foreach ($rooms as $room)
        <option value="{{ $room->room_id }}" {{ $room->room_id === old('room_id') ? 'selected' : '' }}>{{ $room->name }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
     </div>

     <div class="col">
      <x-Dashboard.Forms.Select name="Khung Giờ" property="time_slot_id">
        @foreach ($time_slots as $time_slot)
        <option value="{{ $time_slot->time_slot_id }}" {{  $time_slot->time_slot_id === old('time_slot_id') ? 'selected' : '' }}>{{ $time_slot->time_start .' - '. $time_slot->time_end }}</option>
        @endforeach
      </x-Dashboard.Forms.Select>
     </div>
   </div>
   
    <x-Dashboard.Forms.Select name="Trạng thái" property="status">
      <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Đang chiếu</option>
      <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Dừng chiếu</option>
    </x-Dashboard.Forms.Select>
  </x-Dashboard.Forms.FormCreate>
</div>

<div class="py-1">
  <x-Dashboard.Tables.Table name="lịch chiếu" :columns="$columns" :value="$shows">
    @foreach ($shows as $show)
    <tr>
      <td>{{ $show->show_id }}</td>
      <td>{{ $show->timeSlot->time_start .' - '. $show->timeSlot->time_end }}</td>
      <td>{{ $show->room->name }}</td>
      <td class="col-sm-1">
        <x-Dashboard.Shared.ButtonAction :id="$show->show_id" show="show.show" edit="show.edit"
          delete="show.destroy" />
      </td>
    </tr>
    @endforeach
  </x-Dashboard.Tables.Table>
</div>
@endsection

@push('scripts')
<script>
  const selectTimeSlotIdField = d.querySelector('#inputTime_slot_id');
  if(selectTimeSlotIdField) {
    const choices = new Choices(selectTimeSlotIdField); 
  }

  const selectRoomIdField = d.querySelector('#inputRoom_id');
  if(selectRoomIdField) {
    const choices = new Choices(selectRoomIdField); 
  }

</script>
@endpush