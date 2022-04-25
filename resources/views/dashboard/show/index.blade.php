@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Lịch Chiếu')

@php
$breadcrumbs = [
[
'name' => 'Danh sách lịch chiếu',
'url' => route('show.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'name' => 'Tên',
'date' => 'Ngày Chiếu',
'time_start' => 'Giờ Chiếu',
'movie' => 'Phim',
'room' => 'Phòng Chiếu',
'action' => '',
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Lịch Chiếu' url='show.choose.movie' />
</div>

<x-Dashboard.Tables.Table name="lịch chiếu" :columns="$columns" :value="$shows">
  @foreach ($shows as $show)
  <tr>
    <td>{{ $show->show_id }}</td>
    <td>{{ $show->date }}</td>
    <td>{{ $show->movie->title }}</td>
    <td>{{ $show->room->name }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$show->show_id" show="show.show" edit="show.edit"
        delete="show.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection