@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ghế',
'url' => route('seat.index'),
'active' => false,
],
[
'name' => 'Chi tiết ghế',
'url' => route('seat.show', $seat->seat_id),
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
          <h5 class="mt-2 font-weight-bold text-primary float-left">Ghế
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
                <td>{{ $seat->seat_id }}</td>
              </tr>
              <tr>
                <td>Mã</td>
                <td>{{ $seat->name }}</td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td>{{ $seat->created_at->format('d-m-Y') }}
                  - {{ $seat->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $seat->updated_at->format('d-m-Y') }}
                  - {{ $seat->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$seat->seat_id" edit="seat.edit" delete="seat.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection