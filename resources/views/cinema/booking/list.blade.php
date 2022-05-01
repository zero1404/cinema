@extends('cinema.layouts.app')
@section('title', 'Danh Sách Đơn Đặt Hàng')

@section('content')
<section class="ftco-section ftco-cart padding-top">
    @if (!$bookings || count($bookings) == 0)
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="card">
                    <div class="card-header cart-empty">
                        <h5 class="my-auto"><span class="icon-shopping-cart mr-1"></span> Đơn Đặt Hàng</h5>
                    </div>
                    <div class="card-body cart">
                        <div class="col-sm-12 text-center"> <img src="{{ asset('cinema/images/empty-cart.png') }}"
                                width="130" height="130" class="img-fluid mb-4 mr-3">
                            <h3>
                                Bạn chưa đặt đơn hàng nào
                            </h3>
                            <a href="{{ route('cinema.home') }}" class="btn btn-primary btn-lg m-3">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container padding-top">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table" style="color: #fff">
                        <thead>
                            <tr class="text-center">
                                <th>Mã</th>
                                <th>Ngày tạo đơn</th>
                                <th>Tổng</th>
                                <th>Trạng Thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr class="text-center">
                                <td> {{ $booking->booking_number }}</td>
                                <td> {{ $booking->created_at->format('d/m/Y') }}</td>
                                <td>
                                    {{ Helpers::formatCurrency($booking->amount) }}
                                </td>
                                <td class="text-center">
                                  {!! Helpers::displayStatusBooking($booking->status) !!}
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('cinema.booking.detail', $booking->booking_id) }}">Xem chi
                                        tiết</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $bookings->links() }}
                </div>

            </div>
        </div>
    </div>
    @endif
</section>
@endsection