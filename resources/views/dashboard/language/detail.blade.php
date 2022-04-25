@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Ngôn Ngữ')

@php
$breadcrumbs = [
[
'name' => 'Danh sách ngôn ngữ',
'url' => route('language.index'),
'active' => false,
],
[
'name' => 'Chi tiết ngôn ngữ',
'url' => route('language.show', $language->language_id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="mt-2 font-weight-bold text-primary float-left">Ngôn Ngữ
          </h5>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="col-sm-3">#</th>
                <th class="col-sm-9">Thông tin</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ID</td>
                <td>{{ $language->language_id }}</td>
              </tr>
              <tr>
                <td>Mã</td>
                <td>{{ $language->name }}</td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td>{{ $language->created_at->format('d-m-Y') }}
                  - {{ $language->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $language->updated_at->format('d-m-Y') }}
                  - {{ $language->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$language->language_id" edit="language.edit" delete="language.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection