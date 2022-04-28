@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Lịch Chiếu')

@php
$breadcrumbs = [
[
'name' => 'Danh sách lịch chiếu',
'url' => route('show.index'),
'active' => false,
],
[
'name' => 'Chi tiết lịch chiếu',
'url' => route('show.show', $show->show_id),
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
          <h5 class="mt-2 font-weight-bold text-primary float-left">Lịch Chiếu
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
                <td>{{ $show->show_id }}</td>
              </tr>
              <tr>
                <td>Tên Phim</td>
                <td>{{ $show->movie->title }}</td>
              </tr>
              <tr>
                <td>Phòng Chiếu</td>
                <td>{{ $show->room->name }}</td>
              </tr>
              <tr>
                <td>Khung Giờ</td>
                <td>{{ $show->timeSlot->time_start .' - '. $show->timeSlot->time_end }}</td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td>{{ $show->created_at->format('d-m-Y') }}
                  - {{ $show->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $show->updated_at->format('d-m-Y') }}
                  - {{ $show->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$show->show_id" edit="show.edit" delete="show.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection