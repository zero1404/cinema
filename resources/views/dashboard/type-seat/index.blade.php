@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Loại Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách loại ghế',
'url' => route('type-seat.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'name' => 'Tên Loại Ghế',
'price' => 'Giá',
'action' => '',
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Loại Ghế' url='type-seat.create' />
</div>

<x-Dashboard.Tables.Table name="ghế" :columns="$columns" create="seat.create" :value="$seats">
  @foreach ($seats as $type_seat)
  <tr>
    <td>{{ $type_seat->type_seat_id }}</td>
    <td>{{ $type_seat->name }}</td>
    <td>{{ Helpers::formatCurrency($type_seat->price) }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$type_seat->type_seat_id" show="type-seat.show" edit="type-seat.edit"
        delete="type-seat.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection