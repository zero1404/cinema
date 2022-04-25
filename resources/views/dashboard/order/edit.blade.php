@extends('dashboard.layouts.app')
@section('title', 'Sửa Đơn Hàng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách đơn hàng',
'url' => route('order.index'),
'active' => false
],
[
'name' => 'Tạo tài khoản',
'url' => route('order.edit', $order->id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Đơn Đặt Hàng" route="order.update" :id="$order->id">
    <x-Dashboard.Forms.Select name="Trạng thái" property="status">
      @if ($order->status != 'done')
      @if ($order->status != 'delivering' && $order->status != 'accepted')
      <option value="new" {{ $order->status == 'new' ? 'selected' : '' }}>Mới</option>
      <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>Chấp nhận</option>
      @endif
      <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Đang vận chuyển</option>
      <option value="cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>Huỷ</option>
      @endif
      @if ($order->status != 'cancel')
      <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Hoàn thành</option>
      @endif
    </x-Dashboard.Forms.Select>

    <x-Dashboard.Forms.Textarea name="Ghi chú" property="note" placeholder="Nhập ghi chú" :value="$order->note" />
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection