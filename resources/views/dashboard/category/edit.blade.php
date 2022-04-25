@extends('dashboard.layouts.app')
@section('title', 'Sửa Danh Mục Sản Phẩm')

@php
$breadcrumbs = [
[
'name' => 'Danh sách danh mục',
'url' => route('category.index'),
'active' => false,
],
[
'name' => 'Sửa danh mục',
'url' => route('category.edit', $category->category_id),
'active' => true,
]
];
@endphp

@section('content')
<div class='py-4'>
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />

  <x-Dashboard.Forms.FormEdit name="Danh Mục" route="category.update" :id="$category->category_id">
    <x-Dashboard.Forms.Input name="Tiêu đề" property="title" type="text" placeholder="Nhập tiêu đề"
      value="{{ $category->title }}" />

    <x-Dashboard.Forms.Textarea name="Mô tả" property="description" placeholder="Nhập mô tả"
      value="{{ $category->description }}" placeholder="Nhập mô tả" />

  </x-Dashboard.Forms.FormEdit>
</div>
@endsection