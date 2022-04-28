@extends('cinema.layouts.app')
@section('title', 'Boleto Cinema VietNam')

@section('content')

    <x-Cinema.Shared.Banner />
  
    <x-Cinema.Shared.TicketSearch />

    <!-- ==========Movie-Section========== -->
    <section class="movie-section padding-top padding-bottom">
      <div class="container">
          <div class="tab">
              <div class="section-header-2">
                  <div class="left">
                      <h2 class="title">Phim</h2>
                      <p>Hãy chắc chắn không bỏ lỡ những bộ phim ngày hôm nay.</p>
                  </div>
                  <ul class="tab-menu">
                      <li class="active">
                          Đang chiếu 
                      </li>
                      <li>
                          Sắp chiếu
                      </li>
                  </ul>
              </div>
              <div class="tab-area mb-30-none">
                  <div class="tab-item active">
                      <div class="owl-carousel owl-theme tab-slider">
                          @foreach ($movies_now_showing as $movie)
                            <x-Cinema.Movie.Item :movie="$movie" />
                          @endforeach
                      </div>
                  </div>
                  <div class="tab-item">
                      <div class="owl-carousel owl-theme tab-slider">
                        @foreach ($movies_up_comming as $movie)
                            <x-Cinema.Movie.Item :movie="$movie" />
                        @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <!-- ==========Movie-Section========== -->
@endsection