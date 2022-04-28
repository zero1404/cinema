@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ghế',
'url' => route('seat.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'name' => 'Tên Ghế',
'room' => 'Phòng',
'type_seat' => 'Loại Ghế',
'action' => '',
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Ghế' url='seat.create' />
</div>

<x-Dashboard.Tables.Table name="ghế" :columns="$columns" create="seat.create" :value="$seats">
  @foreach ($seats as $seat)
  <tr>
    <td>{{ $seat->seat_id }}</td>
    <td>{{ $seat->name }}</td>
    <td>{{ $seat->room->name }}</td>
    <td>{{ $seat->typeSeat->name }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$seat->seat_id" show="seat.show" edit="seat.edit"
        delete="seat.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection