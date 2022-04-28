@extends('cinema.layouts.app')
@section('title', 'Chọn lịch chiếu')

@section('content')
<!-- ==========Banner-Section========== -->
<section class="details-banner hero-area bg_img" data-background="{{ Helpers::getMovieImage($movie->images) }}">
  <div class="container">
      <div class="details-banner-wrapper">
          <div class="details-banner-content">
              <h3 class="title">{{ $movie->title }}</h3>
              <div class="tags">
                  <a href="#">{{ $movie->language->name }}</a>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- ==========Banner-Section========== -->

    <!-- ==========Book-Section========== -->
    <section class="book-section bg-one">
      <div class="container">
          <form id="selectDate" method="POST" action="{{ route('cinema.booking.choose-show.handle', $movie->movie_id) }}" class="ticket-search-form two d-flex justify-content-center">
            @csrf
              <div class="form-group">
                  <div class="thumb">
                      <img src="{{ asset('cinema/images/ticket/date.png') }}" alt="ticket">
                  </div>
                  <span class="type">Ngày chiếu</span>
                    <select name="date" onchange="selectDate(event)" class="select-bar" id="date-show">
                      @foreach($list_date as $date)
                      <option value="{{ $date }}" {{ $selected_date->format('Y-m-d') === $date ?  'selected' : '' }}>{{ Helpers::formatDate($date) }}</option>
                      @endforeach
                    </select>
              </div>
          </form>
      </div>
  </section>
  <!-- ==========Book-Section========== -->

<!-- ==========Movie-Section========== -->
<div class="ticket-plan-section">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-12 mb-5 mb-lg-0 padding-bottom">
              <ul class="seat-plan-wrapper bg-five">
                @foreach($list_shows as $show)
                  <li>
                      <div class="movie-name">
                          <p  class="name">{{ $show->room->name }}</p>
                      </div>
                      <div class="movie-schedule">
                        <div class="d-flex align-items-center">
                          <div class="item">
                              {{ $show->timeSlot->time_start}}
                          </div>
                          đến
                          <div class="item">
                              {{ $show->timeSlot->time_end}}
                          </div>
                        </div>
                        <div class="movie-choose-btn">
                          @if($show->date === \Carbon\Carbon::today()->format('Y-m-d') && $show->timeSlot->time_start < Helpers::getNowTime())
                          <button class="btn btn-secondary btn-sm">Đã chiếu</button>
                          @else
                          <a href="{{ route('cinema.booking.choose-seat', ['movieId' => $movie->movie_id, 'showId' => $show->show_id]) }}" class="btn btn-warning">Chọn</a>
                          @endif
                        </div>
                      </div>
                  </li>   
                @endforeach                     
              </ul>
          </div>
      </div>
  </div>
</div>
<!-- ==========Movie-Section========== -->

@endsection

@push('scripts')
<script>
  function selectDate(event) {
    event.preventDefault();
    $("#selectDate").submit();
  }
</script>
@endpush