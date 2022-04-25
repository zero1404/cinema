@extends('dashboard.layouts.app')
@section('title', 'Sửa Khung Giờ')

@php
$breadcrumbs = [
  [
'name' => 'Danh sách khung giờ',
'url' => route('time-slot.index'),
'active' => false,
],
[
'name' => 'Sửa khung giờ',
'url' => route('time-slot.edit', $time_slot->time_slot_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Khung Giờ" route="time-slot.update" :id="$time_slot->time_slot_id">
    <x-Dashboard.Forms.Input name="Giờ bắt đầu" property="time_start" type="text" placeholder="Nhập giờ bắt đầu" value="{{ $time_slot->time_start }}" />
    <x-Dashboard.Forms.Input name="Giờ kết thúc" property="time_end" type="text" placeholder="Nhập giờ kết thúc" value="{{ $time_slot->time_end }}" />
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection

@push('scripts')
<script>
    $('#inputTime_start').timepicker({
    timeFormat: 'H:m',
    dropdown: true,
    scrollbar: true
});


$('#inputTime_end').timepicker({
    timeFormat: 'H:m',
    dropdown: true,
    scrollbar: true
});
</script>
@endpush