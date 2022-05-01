@extends('cinema.layouts.app')
@section('title', 'Chi tiết đơn đặt hàng')

@section('content')
    <div class="container padding-top padding-bottom d-flex justify-content-center">
      <div class="col-lg-8">
        <div class="booking-summery bg-one">
            <h4 class="title">Thông Tin Thanh Toán</h4>
            <ul>
              <li>
                <div class="d-flex justify-content-center">
                  <div class="bg-white p-2" style="max-width: 215px">
                    {!! QrCode::size(200)->generate($booking->booking_number) !!}
                  </div>
                </div>
              </li>
                <li>
                    <h6 class="subtitle">{{ $booking->show->movie->title }}</h6>
                    <span class="info">{{ $booking->show->movie->language->name }}</span>
                    <span class="info">{{ $booking->show->room->name }}</span>
                    <span class="info">{{ $booking->show->timeSlot->time_start. '-'. $booking->show->timeSlot->time_end }}</span>
                </li>
                @foreach($booking->tickets as $ticket)
                <li>
                    <h6 class="subtitle"><span>{{ $ticket->seat->typeSeat->name }}</span></h6>
                    <div class="info"><span>{{ Helpers::formatCurrency($ticket->price) }}</span><span>Số ghế: {{ $ticket->seat->name }}</span></div>
                </li>
                @endforeach
            </ul>
            <ul class="side-shape">
            </ul>
            <ul>
                <li>
                    <span class="info"><span>Giảm giá</span><span>{{ Helpers::formatCurrency(0) }}</span></span>
                </li>
            </ul>
        </div>
        <div class="proceed-area  text-center">
            <h6 class="subtitle"><span>Tổng tiên</span><span>{{ Helpers::formatCurrency($booking->amount) }}</span></h6>
            <a href="#" class="custom-button back-button">{{ Helpers::getStatusBooking($booking->status) }}</a>
        </div>
    </div>
    </div>
@endsection