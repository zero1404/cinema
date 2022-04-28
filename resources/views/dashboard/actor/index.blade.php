@extends('dashboard.layouts.app')
@section('title', 'Danh sách diễn viên')

@php
$breadcrumbs = [
[
'name' => 'Danh sách diễn viên',
'url' => route('actor.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'fullname' => 'Họ Tên',
'biography' => 'Tiểu Sử',
'action' => '',
];
@endphp
@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Diễn Viên' url='actor.create' />
</div>

<x-Dashboard.Tables.Table name="Diễn Viên" :value="$actors" :columns="$columns">
  @foreach ($actors as $actor)
  <tr>
  <tr>
    <td>{{ $actor->actor_id }}</td>
    <td>
      <div class="d-flex align-items-center">
        <img class="" src="{{Helpers::getUserAvatar($actor->avatar)}}" style="max-width:50px; clip-path: circle();"
          alt="{{ $actor->fullname }}">

        <span class="mx-2">{{ $actor->fullname }}</span>
      </div>
    </td>
    <td>{{ $actor->biography }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$actor->actor_id" show="actor.show" edit="actor.edit"
        delete="actor.destroy" />
    </td>
  </tr>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
</div>
@endsection