@extends('dashboard.layouts.app')
@section('title', 'Sửa Diễn Viên')

@php
$breadcrumbs = [
[
'name' => 'Danh sách diễn viên',
'url' => route('actor.index'),
'active' => false,
],
[
'name' => 'Sửa diễn viên',
'url' => route('actor.create', $actor->actor_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Diễn Viên" route="actor.update" :id="$actor->actor_id">
    <x-Dashboard.Forms.Input name="Họ" property="last_name" type="text" placeholder="Nhập họ" value="{{ $actor->last_name }}" />
    <x-Dashboard.Forms.Input name="Tên" property="first_name" type="text" placeholder="Nhập tên" value="{{ $actor->first_name }}" />
    <x-Dashboard.Forms.InputImage name="Ảnh đại diện" property="avatar" :value="$actor->avatar" />
    <x-Dashboard.Forms.Textarea name="Mô tả" property="description" value="{{ $actor->description }}"
      placeholder="Nhập mô tả" rows="5" />
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection