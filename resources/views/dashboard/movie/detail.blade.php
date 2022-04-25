@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Sản Phẩm')

@php
$breadcrumbs = [
[
'name' => 'Danh sách sách',
'url' => route('movie.index'),
'active' => false,
],
[
'name' => 'Chi tiết sách',
'url' => route('movie.show', $movie->movie_id),
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
          <h5 class="mt-2 font-weight-bold text-primary float-left">Sản Phẩm
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
                <td>{{ $movie->id }}</td>
              </tr>
              <tr>
                <td>Ảnh</td>
                <td><img class="img-thumbnail" style="width: 144px" src="{{ $movie->images }}" />
                </td>
              </tr>
              <tr>
                <td>Tên sản phẩm</td>
                <td>{{ $movie->title }}</td>
              </tr>
              <tr>
                <td>Đường dẫn</td>
                <td>{{ $movie->slug }}</td>
              </tr>

              <tr>
                <td>Mô tả</td>
                <td>{{ substr($movie->description, 0, 420) }}<span id='dot'>...</span><span id="content_readmore">{{
                    substr($movie->description, 420, strlen($movie->description)) }}</span><a id="readmore">Xem
                    thêm</a></td>
              </tr>

              <tr>
                <td>Số lượng</td>
                <td>{{ $movie->quantity }}</td>
              </tr>

              <tr>
                <td>Đã bán</td>
                <td>{{ $movie->sold }}</td>
              </tr>

              <tr>
                <td>Giá</td>
                <td>{{ Helpers::formatCurrency($movie->price) }}</td>
              </tr>

              <tr>
                <td>Chiết khấu</td>
                <td>{{ $movie->discount }} %</td>
              </tr>
              <tr>
                <td>Danh mục</td>
                <td>
                  {{ $movie->category->title }}
                </td>
              </tr>
             
              <tr>
                <td>Ngôn ngữ</td>
                <td>
                  {{ $movie->language->name }}
                </td>
              </tr>
              <tr>
                <td>Trạng thái</td>
                <td>{{ $movie->status == 'active' ? 'Hiển thị' : 'Ẩn' }}</td>
              </tr>

              <tr>
                <td>Ngày tạo</td>
                <td>{{ $movie->created_at->format('d-m-Y') }}
                  - {{ $movie->created_at->format('g: i a') }}</td>
              </tr>
              <tr>
                <td>Ngày cập nhật</td>
                <td>{{ $movie->updated_at->format('d-m-Y') }}
                  - {{ $movie->updated_at->format('g: i a') }}
                </td>
              </tr>
            </tbody>
          </table>

        </div>
        <div class="card-footer d-flex">
          <x-Dashboard.Shared.ButtonDetail :id="$movie->movie_id" edit="movie.edit" delete="movie.destroy" />
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
  #readmore {
    color: #434c57;
    font-size: 14px;
    font-weight: 500;
  }
</style>
@endpush

@push('scripts')
<script>
  $(document).ready(function() {
            const content = $("#content_readmore");
            content.hide();
            $("#readmore").on("click", function() {
                $("#dot").text(content.is(':visible') ? '...' : '')
                $(this).text(content.is(':visible') ? 'Xem thêm' : '[Thu gọn]');
                content.slideToggle(300);
            });
        });
</script>
@endpush