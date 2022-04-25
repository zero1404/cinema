@extends('dashboard.layouts.app')
@section('title', 'Sửa Phim')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phim',
'url' => route('movie.index'),
'active' => false
],
[
'name' => 'Sửa phim',
'url' => route('movie.edit', $movie->movie_id),
'active' => true,
]
];
@endphp

@section('content')
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormEdit name='Phim' route='movie.update' :id="$movie->movie_id">
    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Tiêu đề" property="title" type="text" placeholder="Nhập tiêu đề" value="{{ $movie->title }}" />
      </div>
    </div>

    <x-Dashboard.Forms.Textarea name=" Mô tả" property="description" value="{{ $movie->description }}"
      placeholder="Nhập mô tả" rows="5" />

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Thời lượng" property="duaration" type="text" placeholder="Nhập thời lượng"
        value="{{ $movie->duaration }}" />
      </div>

      <div class="col">
        <x-Dashboard.Forms.Input name="Trailer" property="trailer" type="text" placeholder="Nhập link trailer"
        value="{{ $movie->trailer }}" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Ngày Phát Hành" property="release_date" type="date" placeholder="Nhập ngày phát hành"
        value="{{ $movie->release_date }}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Đạo diễn" property="director" type="text" placeholder="Nhập tên đạo diễn"
        value="{{ $movie->director }}" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Danh mục" property="category_ids[]" multiple="true">
          @foreach ($categories as $category)
          <option value="{{ $category->category_id }}" {{ in_array($category->category_id, $movie->category_ids) ? 'selected' : '' }}>{{ $category->title }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>

      <div class="col">
        <x-Dashboard.Forms.Select name="Diễn viên" property="actor_ids[]" multiple="true">
          @foreach ($actors as $actor)
          <option value="{{ $actor->actor_id }}" {{ in_array($actor->actor_id, $movie->actor_ids) ? 'selected' : ''}}>{{ $actor->fullname }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Ngôn Ngữ" property="language_id">
          @foreach ($languages as $language)
          <option value="{{ $language->language_id }}" {{ $movie->language->language_id == $language->language_id ? 'selected' : ''}}>{{ $language->name }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>

      <div class="col">
        <x-Dashboard.Forms.Select name="Trạng thái" property="status">
          <option value="active" {{ $movie->status == 'active' ? 'selected' : '' }}>Hiển thị</option>
          <option value="inactive" {{ $movie->status == 'inactive' ? 'selected' : '' }}>Ẩn</option>
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <x-Dashboard.Forms.InputImage name="Ảnh" property="images" :value="$movie->images" />
  </x-Dashboard.Forms.FormEdit>
</div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  $('#lfm').filemanager('image');
</script>

<script>
  const selectStatusField = d.querySelector('#inputStatus');
  if(selectStatusField) {
    const choices = new Choices(selectStatusField); 
  }

  const selectCategoryField = document.getElementById('inputCategory_ids[]');
  if(selectCategoryField) {
    const choices = new Choices(selectCategoryField); 
  }

  const selectLanguageField = d.querySelector('#inputLanguage_id');
  if(selectLanguageField) {
    const choices = new Choices(selectLanguageField); 
  }

  const selectActorField = document.getElementById('inputActor_ids[]');
  if(selectActorField) {
    const choices = new Choices(selectActorField); 
  }

</script>
@endpush