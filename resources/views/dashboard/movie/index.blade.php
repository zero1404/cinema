@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Phim')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phim',
'url' => route('movie.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'images' => 'Ảnh',
'title' => 'Tên',
'category' => 'Danh Mục',
'status' => 'Trạng Thái',
'action' => '',
];
@endphp
@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Phim' url='movie.create' />
</div>

<x-Dashboard.Tables.Table name="phim" :columns="$columns" create="movie.create" :value="$movies">
  @foreach ($movies as $movie)
  <tr>
    <td>{{ $movie->movie_id }}</td>
    <td>
      @if ($movie->images)
      @php
      $photo = explode(',', $movie->images);
      @endphp
      <img src="{{ $photo[0] }}" class="img-fluid zoom" style="max-width:80px" alt="{{ $movie->photo }}">
      @else
      <img src="{{ asset('admin/img/thumbnail-default.jpg') }}" class="img-fluid" style="max-width:80px"
        alt="{{ $movie->title }}">
      @endif
    </td>
    <td>{{ $movie->title }}</td>
    <td>{{ $movie->category->title }}</td>
    <td>
      @if ($movie->status == 'active')
      <span class="badge badge-sm bg-success ms-1">Hiển thị</span>
      @else
      <span class="badge badge-sm bg-warning ms-1">Ẩn</span>
      @endif
    </td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$movie->movie_id" show="movie.show" edit="movie.edit"
        delete="movie.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection