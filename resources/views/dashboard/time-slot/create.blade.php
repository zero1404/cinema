@extends('dashboard.layouts.app')
@section('title', 'Tạo Khung Giờ')

@php
$breadcrumbs = [
[
'name' => 'Danh sách khung giờ',
'url' => route('time-slot.index'),
'active' => false,
],
[
'name' => 'Tạo khung giờ',
'url' => route('time-slot.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Khung Giờ" route="time-slot.store">
    <x-Dashboard.Forms.Input name="Giờ bắt đầu" property="time_start" type="text" placeholder="Nhập giờ bắt đầu" value="{{ old('time_start') }}" />
    <x-Dashboard.Forms.Input name="Giờ kết thúc" property="time_end" type="text" placeholder="Nhập giờ kết thúc" value="{{ old('time_end') }}" />
  </x-Dashboard.Forms.FormCreate>
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