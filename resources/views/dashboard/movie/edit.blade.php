@extends('dashboard.layouts.app')
@section('title', 'Sửa Sản Phẩm')

@php
$breadcrumbs = [
[
'name' => 'Danh sách sách',
'url' => route('product.index'),
'active' => false
],
[
'name' => 'Sửa sách',
'url' => route('product.edit', $product->id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name="Sản Phẩm" route="product.update" :id="$product->id">
    <x-Dashboard.Forms.Input name="Tiêu đề" property="title" placeholder="Nhập tiêu đề" value="{{ $product->title }}" />

    <x-Dashboard.Forms.Textarea name=" Mô tả" property="description" placeholder="" value="{{ $product->description }}"
      placeholder="Nhập mô tả" rows="5" />

    <x-Dashboard.Forms.Input name="Giá" property="price" type="number" placeholder="Nhập giá"
      value="{{ $product->price }}" />

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Số lượng tồn kho" property="quantity" type="number" placeholder="Nhập số lượng"
          value="{{ $product->quantity }}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Số lượng đã bán" property="sold" type="number" placeholder="Nhập số lượng"
          value="{{ $product->sold }}" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Ngày xuất bản" property="discount" type="date" placeholder="Nhập ngày xuất bản"
          value="12/10/2010" min="0" max="100" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Ngày Tái Bản" property="page_number" type="date" placeholder="Nhập ngày tái bản"
          value="15/04/2021" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Danh mục" property="category_id">
          @foreach ($categories as $parent)
          <optgroup label="{{ $parent->title }}">
            @foreach ($parent->children as $children)
            <option value="{{ $children->id }}" {{ $children->id == $product->category->id ? ' selected' : '' }}>
              {{ $children->title }}</option>
            @endforeach
          </optgroup>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
      <div class="col">
        <x-Dashboard.Forms.Select name="Tác Giả" property="author_id">
          @foreach ($authors as $author)
          <option value="{{ $author->id }}" {{ $author->id == $product->author->id ? ' selected' : '' }}>
            {{ $author->fullname }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Nhà Xuất Bản" property="publisher_id">
          @foreach ($publishers as $publisher)
          <option value="{{ $publisher->id }}" {{ $publisher->id == $product->publisher->id ? ' selected' : '' }}>{{
            $publisher->name }}
          </option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
      <div class="col">
        <x-Dashboard.Forms.Select name="Ngôn Ngữ" property="language_id">
          @foreach ($languages as $language)
          <option value="{{ $language->language_id }}" {{ $language->language_id == $product->language->id ? ' selected' : '' }}>
            {{ $language->name }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Chiết khấu(%)" property="discount" type="number" placeholder="Nhập chiết khấu"
          value="{{ $product->discount }}" min="0" max="100" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Số Trang" property="page_number" type="number" placeholder="Nhập số trang"
          value="{{ $product->page_number }}" />
      </div>
    </div>

    <x-Dashboard.Forms.InputImage name="Ảnh" property="images" :value="$product->images" />

    <x-Dashboard.Forms.Select name="Trạng thái" property="status">
      <option value="active" {{ $product->status == 'active' ? ' selected' : '' }}>Hiển thị
      </option>
      <option value="inactive" {{ $product->status == 'inactive' ? ' selected' : '' }}>Ẩn
      </option>
    </x-Dashboard.Forms.Select>
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  $('#lfm').filemanager('image');
</script>
@endpush