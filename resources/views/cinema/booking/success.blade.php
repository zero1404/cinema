@extends('cinema.layouts.app')
@section('title', 'Đặt vé thành công')

@section('content')
<!-- ==========Banner-Section========== -->
<section class="details-banner hero-area bg_img seat-plan-banner" data-background="{{ Helpers::getMovieImage($movie->images) }}">
  <div class="container">
      <div class="details-banner-wrapper">
          <div class="details-banner-content style-two">
              <h3 class="title">
                {{ $movie->title }}
              </h3>
              <div class="tags">
                  <a href="#">
                    {{ $show->room->name }}
                  </a>
                  <a href="#0">
                    Khung giờ: {{ $show->timeSlot->time_start .' - '. $show->timeSlot->time_end }}
                  </a>
              </div>
          </div>
      </div>
  </div>
</section>
<!-- ==========Banner-Section========== -->
<section class="padding-top padding-bottom">
  <div class="d-md-flex align-items-md-center height-100vh--md">
      <div class="container text-center space-2 space-3--lg">
          <div class="w-md-80 w-lg-60 text-center mx-md-auto py-4 my-5">
            <div class="mb-5  d-flex justify-content-center">
              <div class="bg-white p-2" style="max-width: 325px">
                {!! QrCode::size(300)->generate($booking->booking_number) !!}
              </div>
            </div>
            <div class="mb-5">
                  <h2 class="h2 py-5 text-uppercase">Đặt Vé Thành Công</h2>
                  <p class="py-2">Đưa mã QR code này cho nhân viên để tiến hành thanh toán và lấy vé.</p>
                  <p>Bạn vui lòng thanh toán trước 15 phút kể từ thời gian đặt để hoàn tất quá trình đặt vé.</p>
              </div>
              <a class="custom-button back-button" href="{{ route('cinema.home') }}">Trang Chủ</a>
          </div>
      </div>
  </div>
</section>
@endsection