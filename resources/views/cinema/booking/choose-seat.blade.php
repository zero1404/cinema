@extends('cinema.layouts.app')
@section('title', 'Chọn ghế')

@php

@endphp

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
<div class="seat-plan-section padding-bottom">
    <div class="container">
        <div class="screen-area">
            <h4 class="screen">Chọn Ghế</h4>
            <div class="screen-thumb">
                <img src="{{ asset('cinema/images/movie/screen-thumb.png') }}" alt="Screen">
            </div>
            <div class="screen-wrapper">
                <ul class="seat-area couple">
                    @foreach($group_seat as $letter => $seats)
                    <li class="seat-line">
                        <span>{{$letter}} </span>
                        <ul class="seat--area">
                            <li class="front-seat">
                                <ul>
                                    @foreach($seats as $seat)
                                    <li class="single-seat {{ $seat->isFree($show->show_id) ? 'seat-free' : ''}}">
                                        @if($seat->isFree($show->show_id))
                                        <img src="{{ asset('cinema/images/movie/seat01-free.png') }}" alt="seat"
                                        data-seat-booked="false"
                                        data-seat-name="{{$seat->name}}" 
                                        data-seat-id="{{ $seat->seat_id }}"
                                        data-seat-price="{{ $seat->typeSeat->price }}"
                                        >
                                        @else
                                        <img
                                            src="{{ asset('cinema/images/movie/seat01.png') }}" alt="seat"
                                            data-seat-booked="true"
                                            data-seat-name="{{$seat->name}}" 
                                            data-seat-id="{{ $seat->seat_id }}"  
                                            data-seat-price="{{ $seat->typeSeat->price }}">
                                        @endif
                                        <span class="sit-num">{{$seat->name}}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <span>{{$letter}} </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="proceed-book bg_img" data-background="{{ asset('cinema/images/movie/movie-bg-proceed.jpeg') }}">
            <div class="proceed-to-book">
                <div class="book-item">
                    <span>Ghế đã chọn</span>
                    <h3 class="title" id="seat_selected">...</h3>
                </div>
                <div class="book-item">
                    <span>Giá</span>
                    <h3 class="title" id="amount">0đ</h3>
                </div>
                <div class="book-item">
                    <form method="POST" id="payment-form" action="{{ route('cinema.booking.get-seat-ids', ['movieId' => $movie->movie_id, 'showId' => $show->show_id]) }}">
                        @csrf        
                        <input type="hidden" value="" name="seat_ids" id="seat_ids" />
                        <button id='btnPayment' type="submit" class="custom-button" onclick="payment(event)">Thanh Toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==========Movie-Section========== -->
@endsection

@push('scripts')
<script>
const priceShow = {{ $show->price }}
const listNameSelected = [];
const listIdSelected = [];
let price = 0;

$(".seat-free img").on('click', function(e) {
    const isSeatBooked = $(this).attr("data-seat-booked");
    if (isSeatBooked === 'true') return ;
    const seatId = $(this).attr("data-seat-id");
    const seatName = $(this).attr("data-seat-name");
    const seatPrice = $(this).attr("data-seat-price");

    const indexName = listNameSelected.indexOf(seatName);
    const indexId = listIdSelected.indexOf(seatId);

    if (indexId === -1  && indexName === -1) {
        listNameSelected.push(seatName);
        listIdSelected.push(seatId);

        $(this).attr("src", "{{ asset('cinema/images/movie/seat01-booked.png') }}");
       
        price += +seatPrice;

    } else {
        $(this).attr("src", "{{ asset('cinema/images/movie/seat01-free.png') }}");
        if (indexName > -1) {
            listNameSelected.splice(indexName, 1);
        }

        if (indexId > -1) {
            listIdSelected.splice(indexId, 1);
        }

        price -= +seatPrice;
    }

    $("#seat_ids").val(listIdSelected);
    $("#amount").text(formatCurrency(price) + '');
    $("#seat_selected").text(listNameSelected.join(', '))
});


function payment(event) {
    event.preventDefault();
    if($("#seat_ids").val() === '') {
        notyf.open({
                type: "error",
                message: "Chưa chọn ghế!",
                duration: 3000,
            });
    } else {
        document.getElementById('payment-form').submit();
    }
}

</script>
@endpush