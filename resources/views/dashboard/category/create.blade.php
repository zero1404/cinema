@extends('dashboard.layouts.app')
@section('title', 'Thêm Danh Mục')

@php
$breadcrumbs = [
[
'name' => 'Danh sách danh mục',
'url' => route('category.index'),
'active' => false,
],
[
'name' => 'Tạo danh mục',
'url' => route('category.create'),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name='Danh Mục' route='category.store'>
   
    <x-Dashboard.Forms.Input name="Tiêu đề" property="title" type="text" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />
    <x-Dashboard.Forms.Textarea name="Mô tả" property="description" placeholder="" value="{{ old('description') }}"
      placeholder="Nhập mô tả" />

  </x-Dashboard.Forms.FormCreate>
</div>
@endsection