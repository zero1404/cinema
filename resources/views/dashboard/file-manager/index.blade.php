@extends('dashboard.layouts.app')
@section('title', 'Quản Lý Tập Tin')

@php
$breadcrumbs = [
[
'name' => 'Quản lý tập tin',
'url' => route('dashboard.file-manager'),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
    <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
    <iframe src="/laravel-filemanager?type=image"
        style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
</div>
@endsection