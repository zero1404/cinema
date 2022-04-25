@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Đơn Đặt Hàng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách đơn đặt hàng',
'url' => route('order.index'),
'active' => true
]
];
$columns = [
'id' => 'ID',
'order_number' => 'Mã Đơn',
'fullname' => 'Họ Tên',
'address' => 'Địa Chỉ',
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
  {{--
  <x-Dashboard.Shared.ButtonCreate name='Taọ Đơn Đặt Hàng' url='order.create' /> --}}
</div>

<x-Dashboard.Tables.Table name="đơn đặt hàng" :columns="$columns" create="order.create" :value="$orders">
  @foreach ($orders as $order)
  <tr>
    <td>{{ $order->id }}</td>
    <td>{{ $order->order_number }}</td>
    <td>{{ $order->fullname }}</td>
    <td>{{ $order->address }}</td>
    <td>{{ $order->email }}</td>
    <td>{{ $order->telephone }}</td>
    <td class="text-center">
      {!! Helpers::displayStatusOrder($order->status) !!}
    </td>
    <td>{{ Helpers::formatCurrency($order->total) }}</td>
    <td>
      <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm float-left mr-1 btn-action"
        data-toggle="tooltip" title="Xem" data-placement="bottom"><i class="fas fa-info-circle"></i></a>
      <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning btn-sm float-left mr-1 btn-action"
        data-toggle="tooltip" title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection