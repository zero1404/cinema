@extends('dashboard.layouts.app')
@section('title', 'Tạo Phim')

@php
$breadcrumbs = [
[
'name' => 'Danh sách phim',
'url' => route('movie.index'),
'active' => false
],
[
'name' => 'Tạo phim',
'url' => route('movie.create'),
'active' => true,
]
];
@endphp

@section('content')
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <x-Dashboard.Forms.FormCreate name='Phim' route='movie.store'>
    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Tiêu đề" property="title" type="text" placeholder="Nhập tiêu đề" value="{{ old('title') }}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Thời lượng" property="duaration" type="text" placeholder="Nhập thời lượng"
        value="{{old('duaration')}}" />
        <x-Dashboard.Forms.Input name="Trailer" property="trailer" type="text" placeholder="Nhập link trailer"
        value="{{old('trailer')}}" />
      </div>
    </div>

    <x-Dashboard.Forms.Textarea name=" Mô tả" property="description" value="{{ old('description') }}"
      placeholder="Nhập mô tả" rows="5" />

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Input name="Ngày Phát Hành" property="release_date" type="date" placeholder="Nhập ngày phát hành"
        value="{{ old('release_date') }}" />
      </div>
      <div class="col">
        <x-Dashboard.Forms.Input name="Đạo diễn" property="director" type="text" placeholder="Nhập tên đạo diễn"
        value="{{ old('director') }}" />
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Diễn viên" property="actor_ids[]" multiple="true">
          @foreach ($actors as $actor)
          <option value="{{ $actor->actor_id }}">{{ $actor->fullname }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Danh mục" property="category_id">
          @foreach ($categories as $category)
          <option value="{{ $category->category_id }}">{{ $category->title }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <x-Dashboard.Forms.Select name="Ngôn Ngữ" property="language_id">
          @foreach ($languages as $language)
          <option value="{{ $language->language_id }}">{{ $language->name }}</option>
          @endforeach
        </x-Dashboard.Forms.Select>
      </div>

      <div class="col">
        <x-Dashboard.Forms.Select name="Trạng thái" property="status">
          <option value="active">Hiển thị</option>
          <option value="inactive">Ẩn</option>
        </x-Dashboard.Forms.Select>
      </div>
    </div>

    <x-Dashboard.Forms.InputImage name="Ảnh" property="images" />
  </x-Dashboard.Forms.FormCreate>
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

  const selectCategoryField = d.querySelector('#inputCategory_id');
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