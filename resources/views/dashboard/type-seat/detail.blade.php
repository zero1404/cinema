@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Loại Ghế')

@php
$breadcrumbs = [
[
'name' => 'Danh sách loại ghế',
'url' => route('type-seat.index'),
'active' => false,
],
[
'name' => 'Chi tiết loại ghế',
'url' => route('type-seat.show', $type_seat->type_seat_id),
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
          <h5 class="mt-2 font-weight-bold text-primary float-left">Loại Ghế
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
                <td>{{ $type_seat->type_seat_id }}</td>
              </tr>
              <tr>
                <td>Mã</td>
                <td>{{ $type_seat->name }}</td>
              </tr>
              <tr>
                <td>Giá</td>
                <td>{{ Helpers::formatCurrency($type_seat->price) }}</td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td>{{ $type_seat->created_at->format('d-m-Y') }}
                  - {{ $type_seat->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $type_seat->updated_at->format('d-m-Y') }}
                  - {{ $type_seat->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$type_seat->type_seat_id" edit="seat.edit" delete="seat.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection