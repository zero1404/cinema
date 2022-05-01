@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Phòng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phòng',
'url' => route('room.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'name' => 'Tên',
'total_seat' => 'Số Ghế',
'action' => '',
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Phòng' url='room.create' />
</div>

<x-Dashboard.Tables.Table name="phòng" :columns="$columns" create="room.create" :value="$rooms">
  @foreach ($rooms as $room)
  <tr>
    <td>{{ $room->room_id }}</td>
    <td>{{ $room->name }}</td>
    <td>{{ count($room->seat()) }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$room->room_id" show="room.show" edit="room.edit"
        delete="room.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection