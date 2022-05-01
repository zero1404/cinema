@extends('cinema.layouts.app')
@section('title', '')

@section('content')
    <!-- ==========Banner-Section========== -->
    <section class="banner-section">
      <div class="banner-bg bg_img bg-fixed" data-background="{{ asset('cinema/images/banner/banner02.jpg') }}"></div>
      <div class="container">
          <div class="banner-content">
              <h1 class="title bold">Đặt Vé Xem <span class="color-theme">Phim</span></h1>
              <p>Mua trước vé xem phim, tìm thời gian chiếu phim, xem đoạn giới thiệu, đọc bài phê bình phim và hơn thế nữa</p>
          </div>
      </div>
  </section>
  <!-- ==========Banner-Section========== -->

  <x-Cinema.Shared.TicketSearch />

  <!-- ==========Movie-Section========== -->
  <section class="movie-section padding-top padding-bottom">
      <div class="container">
          <div class="row flex-wrap-reverse justify-content-center">
              <div class="col-sm-10 col-md-8 col-lg-3">
                  <div class="widget-1 widget-check">
                      <div class="widget-header">
                          <h5 class="m-title">Lọc</h5> 
                      </div>
                  </div>
                  <div class="widget-1 widget-check">
                      <div class="widget-1-body">
                          <h6 class="subtitle">Thể Loại</h6>
                          <div class="check-area">
                              @foreach(Helpers::getListCategory() as $category)
                              <div class="form-group">
                                  <input type="checkbox" name="genre" id="{{ $category->slug }}"><label for="genre1">{{ $category->title }}</label>
                              </div>
                              @endforeach
                          </div>
                          <div class="add-check-area">
                              <a href="#0">Xem thêm <i class="plus"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-9 mb-50 mb-lg-0">
                  <div class="filter-tab tab">
                      <div class="filter-area">
                          <div class="filter-main">
                              <div class="left">
                                  <div class="item">
                                      <span class="show">Show :</span>
                                      <select class="select-bar">
                                          <option value="12">12</option>
                                          <option value="15">15</option>
                                          <option value="18">18</option>
                                          <option value="21">21</option>
                                          <option value="24">24</option>
                                          <option value="27">27</option>
                                          <option value="30">30</option>
                                      </select>
                                  </div>
                                  <div class="item">
                                      <span class="show">Sort By :</span>
                                      <select class="select-bar">
                                          <option value="showing">now showing</option>
                                          <option value="exclusive">exclusive</option>
                                          <option value="trending">trending</option>
                                          <option value="most-view">most view</option>
                                      </select>
                                  </div>
                              </div>
                              <ul class="grid-button tab-menu">
                                  <li class="active">
                                      <i class="fas fa-th"></i>
                                  </li>                            
                                  <li>
                                      <i class="fas fa-bars"></i>
                                  </li>                            
                              </ul>
                          </div>
                      </div>
                      <div class="tab-area">
                          <div class="tab-item active">
                              <div class="row mb-10 justify-content-center">
                                @foreach($movies as  $movie)
                                  <div class="col-sm-6 col-lg-4">
                                     <x-Cinema.Movie.Item :movie="$movie" />
                                  </div>
                                @endforeach
                              </div>
                          </div>
                          <div class="tab-item">
                              <div class="movie-area mb-10">
                                @foreach($movies as  $movie)
                                  <div class="movie-list">
                                      <div class="movie-thumb c-thumb">
                                          <a href="{{ route('cinema.movie.detail', $movie->slug)}}" class="w-100 bg_img h-100" data-background="{{ Helpers::getMovieImage($movie->images) }}">
                                              <img class="d-sm-none" src="{{ Helpers::getMovieImage($movie->images) }}" alt="movie">
                                          </a>
                                      </div>
                                      <div class="movie-content bg-one">
                                          <h5 class="title">
                                              <a href="{{ route('cinema.movie.detail', $movie->slug)}}">{{ $movie->title }}</a>
                                          </h5>
                                          <p class="duration">{{ $movie->duaration }}</p>
                                          <div class="movie-tags">
                                              @foreach($movie->categories as $category)
                                              <a href="{{ route('cinema.movie.list.category', $category->slug) }}">{{ $category->title }}</a>
                                              @endforeach
                                          </div>
                                          <div class="release">
                                              <span>Khởi chiếu : </span> <a href="#0">{{ Helpers::formatDate($movie->release_date)}}</a>
                                          </div>
                                          <div class="book-area">
                                              <div class="book-ticket">
                                                  <div class="react-item mr-auto">
                                                      <a href="{{ route('cinema.movie.detail', $movie->slug)}}">
                                                          <div class="thumb">
                                                              <img src="{{ asset('cinema/images/icons/book.png') }}" alt="icons">
                                                          </div>
                                                          <span>Đặt Vé</span>
                                                      </a>
                                                  </div>
                                                  <div class="react-item">
                                                      <a href="{{ $movie->trailer }}" class="popup-video">
                                                          <div class="thumb">
                                                              <img src="{{ asset('cinema/images/icons/play-button.png') }}" alt="icons">
                                                          </div>
                                                          <span>Xem Trailer</span>
                                                      </a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                      {{-- <div class="pagination-area text-center">
                          <a href="#0"><i class="fas fa-angle-double-left"></i><span>Prev</span></a>
                          <a href="#0">1</a>
                          <a href="#0">2</a>
                          <a href="#0" class="active">3</a>
                          <a href="#0">4</a>
                          <a href="#0">5</a>
                          <a href="#0"><span>Next</span><i class="fas fa-angle-double-right"></i></a>
                      </div> --}}
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- ==========Movie-Section========== -->
@endsection