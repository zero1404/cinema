@extends('dashboard.layouts.app')
@section('title', 'Danh sách danh mục')

@php
$breadcrumbs = [
[
'name' => 'Danh sách danh mục',
'url' => route('category.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'title' => 'Tiêu Đề',
'description' => 'Mô Tả',
'slug' => 'Đường Dẫn',
'action' => '',
];
@endphp
@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Danh Mục' url='category.create' />
</div>

<x-Dashboard.Tables.Table name="Danh Mục" :value="$categories" :columns="$columns">
  @foreach ($categories as $category)
  <tr>
    <td>{{ $category->category_id }}</td>
    <td>{{ $category->title }}</td>
    <td>{{ $category->description }}</td>
    <td>{{ $category->slug }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$category->category_id" show="category.show" edit="category.edit"
        delete="category.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
</div>
@endsection