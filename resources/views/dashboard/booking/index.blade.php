@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Đơn Đặt Hàng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách đơn đặt hàng',
'url' => route('booking.index'),
'active' => true
]
];
$columns = [
'id' => 'ID',
'order_number' => 'Mã Đơn',
'fullname' => 'Họ Tên',
'email' => 'Email',
'telephone' => 'Số Điện Thoại',
'status' => 'Trạng Thái',
'total' => 'Tổng',
'' => '',
];
@endphp

@section('content')
<div class="pt-4 pb-0">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
</div>

<x-Dashboard.Tables.Table name="Đơn" :columns="$columns" create="booking.create" :value="$bookings">
  @foreach ($bookings as $booking)
  <tr>
    <td>{{ $booking->booking_id }}</td>
    <td>{{ $booking->booking_number }}</td>
    <td>{{ $booking->fullname }}</td>
    <td>{{ $booking->email }}</td>
    <td>{{ $booking->telephone }}</td>
    <td>{!! Helpers::displayStatusBooking($booking->status) !!}</td>
    <td>{{ Helpers::formatCurrency($booking->amount) }}</td>
    <td>
      <a href="{{ route('booking.show', $booking->booking_id) }}" class="btn btn-primary btn-sm float-left mr-1 btn-circle"
        data-toggle="tooltip" title="Xem" data-placement="bottom"><i class="fas fa-info-circle"></i></a>
        <a href="{{ route('booking.edit', $booking->booking_id) }}" class="btn btn-warning text-white btn-sm float-left mr-1 btn-circle"
          data-toggle="tooltip" title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection