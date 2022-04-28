@extends('cinema.layouts.app')
@section('title', $movie->title)

@section('content')
    <!-- ==========Banner-Section========== -->
    <section class="details-banner bg_img" data-background="{{ asset('cinema/images/banner/banner03.jpg') }}">
      <div class="container">
          <div class="details-banner-wrapper">
              <div class="details-banner-thumb">
                  <img src="{{ Helpers::getMovieImage($movie->images) }}" alt="{{ $movie->title }}">
                  <a href="{{ $movie->trailer }}" class="video-popup">
                      <img src="{{ asset('cinema/images/movie/video-button.png') }}" alt="{{ $movie->title }}">
                  </a>
              </div>
              <div class="details-banner-content offset-lg-3">
                  <h3 class="title">{{ $movie->title }}</h3>
                  <div class="tags">
                      <a href="#">{{ $movie->language->name }}</a>
                  </div>
                  @foreach($movie->categories as $category)
                  <a href="" class="button">{{ $category->title}}</a>
                  @endforeach
                  <div class="social-and-duration">
                      <div class="duration-area">
                          <div class="item">
                              <i class="fas fa-calendar-alt"></i><span>{{ Helpers::formatDate($movie->release_date) }}</span>
                          </div>
                          <div class="item">
                              <i class="far fa-clock"></i><span>{{ $movie->duaration }}</span>
                          </div>
                      </div>
                      <ul class="social-share">
                          <li><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                          <li><a href="#0"><i class="fab fa-twitter"></i></a></li>
                          <li><a href="#0"><i class="fab fa-pinterest-p"></i></a></li>
                          <li><a href="#0"><i class="fab fa-linkedin-in"></i></a></li>
                          <li><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                      </ul>
                  </div>
              </div>
          </div>

      </div>
  </section>
  <!-- ==========Banner-Section========== -->
    <!-- ==========Book-Section========== -->
    <section class="book-section bg-one">
      <div class="container">
          <div class="book-wrapper offset-lg-3">
              <a href="{{ route('cinema.booking.choose-show', $movie->movie_id) }}" class="custom-button">Đặt vé</a>
          </div>
      </div>
  </section>
  <!-- ==========Book-Section========== -->

  <!-- ==========Movie-Section========== -->
  <section class="movie-details-section padding-top padding-bottom">
      <div class="container">
          <div class="row justify-content-center flex-wrap-reverse mb--50">
              <div class="col-lg-12 mb-50">
                  <div class="movie-details">
                      <div class="tab summery-review">
                          <ul class="tab-menu">
                              <li class="active">
                                  Thông Tin
                              </li>
                          </ul>
                          <div class="tab-area">
                              <div class="tab-item active">
                                  <div class="item">
                                      <h5 class="sub-title">Mô Tả</h5>
                                      <p>{{ $movie->description }}</p>
                                  </div>
                                  <div class="item">
                                      <div class="header">
                                          <h5 class="sub-title">Diễn Viên</h5>
                                          <div class="navigation">
                                              <div class="cast-prev"><i class="flaticon-double-right-arrows-angles"></i></div>
                                              <div class="cast-next"><i class="flaticon-double-right-arrows-angles"></i></div>
                                          </div>
                                      </div>
                                      <div class="casting-slider owl-carousel">
                                        @foreach($movie->actors as $actor)
                                          <div class="cast-item">
                                              <div class="cast-thumb">
                                                  <a href="#">
                                                      <img src="{{ Helpers::getUserAvatar($actor->avatar) }}" alt="{{ $actor->fullname }}">
                                                  </a>
                                              </div>
                                              <div class="cast-content">
                                                  <h6 class="cast-title"><a href="#0">{{ $actor->fullname }}</a></h6>
                                              </div>
                                          </div>
                                        @endforeach
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- ==========Movie-Section========== -->
@endsection