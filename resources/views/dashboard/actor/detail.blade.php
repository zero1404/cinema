@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Diễn Viên')

@php
$breadcrumbs = [
[
'name' => 'Danh sách diễn viên',
'url' => route('actor.index'),
'active' => false,
],
[
'name' => 'Chi tiết diễn viên',
'url' => route('actor.show', $actor->actor_id),
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
          <h5 class="mt-2 font-weight-bold text-primary float-left">Diễn Viên
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
                <td>{{ $actor->actor_id }}</td>
              </tr>
              <tr>
                <td>Ảnh đại diện</td>
                <td><img class="img-thumbnail" style="width: 144px" src="{{ Helpers::getUserAvatar($actor->avatar) }}" /> </td>
              </tr>
              <tr>
                <td>Họ tên</td>
                <td>{{ $actor->fullname }}</td>
              </tr>
              <tr>
                <td>Mô tả</td>
                <td>{{ $actor->description ?? '...' }}</td>
              </tr>
              <tr>
                <td>Ngày tạo</td>
                <td>{{ $actor->created_at->format('d-m-Y') }}
                  - {{ $actor->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $actor->updated_at->format('d-m-Y') }}
                  - {{ $actor->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$actor->actor_id" edit="actor.edit" delete="actor.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection