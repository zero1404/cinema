@extends('dashboard.layouts.app')
@section('title', 'Danh Sách Ngôn Ngữ')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ngôn ngữ',
'url' => route('language.index'),
'active' => true
]
];

$columns = [
'id' => 'ID',
'name' => 'Tên',
'action' => '',
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Shared.ButtonCreate name='Taọ Ngôn Ngữ' url='language.create' />
</div>

<x-Dashboard.Tables.Table name="ngôn ngữ" :columns="$columns" create="language.create" :value="$languages">
  @foreach ($languages as $language)
  <tr>
    <td>{{ $language->language_id }}</td>
    <td>{{ $language->name }}</td>
    <td class="col-sm-1">
      <x-Dashboard.Shared.ButtonAction :id="$language->language_id" show="language.show" edit="language.edit"
        delete="language.destroy" />
    </td>
  </tr>
  @endforeach
</x-Dashboard.Tables.Table>
@endsection