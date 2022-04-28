@extends('dashboard.layouts.app')
@section('title', 'Sửa Đơn Hàng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách đơn hàng',
'url' => route('booking.index'),
'active' => false
],
[
'name' => 'Sửa đơn hàng',
'url' => route('booking.edit', $booking->booking_id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Đơn Đặt Hàng" route="booking.update" :id="$booking->booking_id">

    <x-Dashboard.Forms.Select name="Trạng thái" property="status">
      @if($booking->status === 'canceled')
        <option value="canceled" selected>Đã huỷ</option>
      @endif

      @if($booking->status === 'unpaid')
        <option value="paid">Đã thanh toán</option>
        <option value="canceled">Huỷ</option>
      @endif

      @if($booking->status === 'paid')
      <option value="paid" selected>Đã thanh toán</option>
      @endif
    </x-Dashboard.Forms.Select>

  </x-Dashboard.Forms.FormEdit>
</div>
@endsection