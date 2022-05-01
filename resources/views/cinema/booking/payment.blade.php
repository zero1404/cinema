@extends('cinema.layouts.app')
@section('title', 'Thanh toán')

@section('content')
<!-- ==========Banner-Section========== -->
<section class="details-banner hero-area bg_img seat-plan-banner" data-background="{{ Helpers::getMovieImage($movie->images) }}">
    <div class="container">
        <div class="details-banner-wrapper">
            <div class="details-banner-content style-two">
                <h3 class="title">{{ $movie->title }}</h3>
                <div class="tags">
                    <a href="#">{{ $show->room->name }}</a>
                    <a href="#0">Khung giờ: {{ $show->timeSlot->time_start .' - '. $show->timeSlot->time_end }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ==========Banner-Section========== -->

<!-- ==========Movie-Section========== -->
<div class="movie-facility padding-bottom">
  <div class="container">
      <div class="row">
          <div class="col-lg-8">
              <div class="checkout-widget checkout-contact">
                  <h5 class="title">Thông Tin Người Đặt </h5>

                  <form  method="POST" action="" class="checkout-contact-form" id="form-payment">
                    @csrf
                    <div class="form-group">
                          <input type="text" placeholder="Họ" name="last_name" id="last_name" value="{{ Auth()->user()->last_name }}">
                      </div>
                      <div class="form-group">
                          <input type="text" placeholder="Tên" name="first_name" id="first_name" value="{{ Auth()->user()->first_name }}">
                      </div>
                      <div class="form-group">
                          <input type="text" placeholder="Email" name="email" id="email" value="{{ Auth()->user()->email }}">
                      </div>
                      <div class="form-group">
                          <input type="text" placeholder="Số điện thoại" name="telephone" id="telephone" value="{{ Auth()->user()->telephone }}">
                      </div>
                      <input type="hidden" name="movie_id" value="{{ $movie->movie_id }}"/>
                      <input type="hidden" name="show_id" value="{{ $show->show_id }}"/>
                      <input type="hidden" name="seat_ids" value="{{ join(',', $seats->pluck('seat_id')->toArray()) }}"/>
                  </form>
              </div>
              <div class="checkout-widget checkout-card mb-0">
                <h5 class="title">Phương Thức Thanh Toán </h5>
                <div class="tab summery-review">
                    <ul class="tab-menu payment-option">
                        <li class="active">
                            <a href="#0">
                                <img src="{{ asset('cinema/images/payment/card.png ') }}" alt="payment">
                                <span>Tại quầy</span>
                            </a>
                        </li>
                        <li>
                            <a href="#0">
                                <img src="{{ asset('cinema/images/payment/card.png') }}" alt="payment">
                                <span>Thẻ ATM</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-area">
                        <div class="tab-item active">
                            <p class="notice">
                                Quý khách vui lòng thanh toán tại quầy trước 15 phút từ thời gian đặt vé nếu không vé sẽ bị huỷ!
                            </p>
                        </div>
                        <div class="tab-item">
                            <h6 class="subtitle"> </h6>
                            <form class="payment-card-form">
                                <div class="form-group w-100">
                                    <label for="card1">Số thẻ</label>
                                    <input type="text" id="card1">
                                    <div class="right-icon">
                                        <i class="flaticon-lock"></i>
                                    </div>
                                </div>
                                <div class="form-group w-100">
                                    <label for="card2"> Họ Tên</label>
                                    <input type="text" id="card2">
                                </div>
                                <div class="form-group">
                                    <label for="card3">Ngày hạn</label>
                                    <input type="text" id="card3" placeholder="MM/YY">
                                </div>
                                <div class="form-group">
                                    <label for="card4">CVV</label>
                                    <input type="text" id="card4" placeholder="CVV">
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>
          </div>
          
          <div class="col-lg-4">
              <div class="booking-summery bg-one">
                  <h4 class="title">Thông Tin Thanh Toán</h4>
                  <ul>
                      <li>
                          <h6 class="subtitle">{{ $movie->title }}</h6>
                          <span class="info">{{ $movie->language->name }}</span>
                      </li>
                      @foreach($group_seat as $name_seat => $seat)
                      <li>
                          <h6 class="subtitle"><span>{{ $name_seat }}</span><span>{{ count($seat)}}</span></h6>
                          <div class="info"><span>{{ Helpers::formatCurrency(Helpers::getAmountBooking($show, $seat)) }}</span> <span>vé</span></div>
                      </li>
                      @endforeach
                  </ul>
                  <ul class="side-shape">
                  </ul>
                  <ul>
                      <li>
                          <span class="info"><span>Tổng</span><span>{{ Helpers::formatCurrency(Helpers::getAmountBooking($show, $seats)) }}</span></span>
                          <span class="info"><span>VAT</span><span>0 đ</span></span>
                      </li>
                  </ul>
              </div>
              <div class="proceed-area  text-center">
                  <h6 class="subtitle"><span>Tổng tiên</span><span>{{ Helpers::formatCurrency(Helpers::getAmountBooking($show, $seats)) }}</span></h6>
                  <a href="javascript:void(0)" onclick="event.preventDefault();
                  document.getElementById('form-payment').submit();" class="custom-button back-button">Thanh Toán</a>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- ==========Movie-Section========== -->
@endsection