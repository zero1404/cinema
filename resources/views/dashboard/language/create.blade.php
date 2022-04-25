@extends('dashboard.layouts.app')
@section('title', 'Tạo Ngôn Ngữ')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ngôn ngữ',
'url' => route('language.index'),
'active' => false,
],
[
'name' => 'Tạo ngôn ngữ',
'url' => route('language.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name="Ngôn Ngữ" route="language.store">
    <x-Dashboard.Forms.Input name="Tên" property="name" type="text" placeholder="Nhập tên" value="{{ old('name') }}" />
  </x-Dashboard.Forms.FormCreate>
</div>
@endsection