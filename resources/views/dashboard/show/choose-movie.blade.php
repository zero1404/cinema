@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Phim')

@php
$breadcrumbs = [
  [
'name' => 'Danh sách lịch chiếu',
'url' => route('show.index'),
'active' => false
],
[
'name' => 'Chọn phim',
'url' => route('show.choose.movie'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'images' => 'Ảnh',
'title' => 'Tên',
'action' => '',
];
@endphp
@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
</div>

<x-Dashboard.Tables.Table name="phim" :columns="$columns" :value="$movies">
  @foreach ($movies as $movie)
  <tr>
    <td>{{ $movie->movie_id }}</td>
    <td>
      <img src="{{ Helpers::getMovieImage($movie->images) }}" class="img-fluid" style="max-width:80px"
        alt="{{ $movie->title }}">
    </td>
    <td>{{ $movie->title }}</td>
    <td class="col-sm-1">
      <a href="{{ route('show.create.movie', $movie->movie_id )}}" class="btn btn-primary">Tạo Lịch</a>
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection