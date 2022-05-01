@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Phòng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phòng',
'url' => route('room.index'),
'active' => false,
],
[
'name' => 'Chi tiết phòng',
'url' => route('room.show', $room->room_id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="mt-2 font-weight-bold text-primary float-left">Phòng
          </h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="col-sm-3">#</th>
                <th class="col-sm-9">Thông tin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ID</td>
                <td>{{ $room->room_id }}</td>
              </tr>
              <tr>
                <td>Mã</td>
                <td>{{ $room->name }}</td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td>{{ $room->created_at->format('d-m-Y') }}
                  - {{ $room->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $room->updated_at->format('d-m-Y') }}
                  - {{ $room->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$room->room_id" edit="room.edit" delete="room.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection