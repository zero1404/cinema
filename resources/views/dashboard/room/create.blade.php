@extends('dashboard.layouts.app')
@section('title', 'Tạo Phòng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phòng',
'url' => route('room.index'),
'active' => false,
],
[
'name' => 'Tạo phòng',
'url' => route('room.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Phòng" route="room.store">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ old('name') }}" />

    <x-Dashboard.Forms.Select name="Loại ghế" property="seat_id">
      @foreach ($seats as $seat)
      <option value="{{ $seat->seat_id }}" {{ $seat->seat_id === old('seat_id') ? 'selected' : '' }}>{{ $seat->name }}</option>
      @endforeach
    </x-Dashboard.Forms.Select>

    <x-Dashboard.Forms.Input name="Số ghế" property="total_seat" type="number" placeholder="Nhập số ghế" value="{{ old('total_seat') }}" />
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection

@push('scripts')
<script>
  const selectSeatIdField = d.querySelector('#inputSeat_id');
  if(selectSeatIdField) {
    const choices = new Choices(selectSeatIdField); 
  }
</script>
@endpush