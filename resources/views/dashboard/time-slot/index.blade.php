@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Khung Giờ')

@php
$breadcrumbs = [
[
'name' => 'Danh sách khung giờ',
'url' => route('time-slot.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'time_start' => 'Giờ Bắt Đầu',
'time_end' => 'Giờ Kết Thúc',
'action' => '',
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Khung Giờ' url='time-slot.create' />
</div>

<x-Dashboard.Tables.Table name="khung giờ" :columns="$columns" create="time-slot.create" :value="$time_slots">
  @foreach ($time_slots as $time_slot)
  <tr>
    <td>{{ $time_slot->time_slot_id }}</td>
    <td>{{ $time_slot->time_start }}</td>
    <td>{{ $time_slot->time_end }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$time_slot->time_slot_id" show="time-slot.show" edit="time-slot.edit"
        delete="time-slot.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection