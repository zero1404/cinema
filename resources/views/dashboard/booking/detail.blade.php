@extends('dashboard.layouts.app')
@section('title', 'Chi Tiết Đơn Đặt Hàng')

@php
$breadcrumbs = [
[
'name' => 'Danh sách đơn hàng',
'url' => route('booking.index'),
'active' => false,
],
[
'name' => 'Chi tiết đơn hàng',
'url' => route('booking.show', $booking->booking_id),
'active' => true,
]
];
@endphp

@section('content')
<div class="py-4">
  <x-Dashboard.Shared.Breadcrumb :breadcrumbs="$breadcrumbs" />
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5>Đơn Đặt Hàng
      </h5>
    </div>
    <div class="card-body">
      @if ($booking)
      <section class="confirmation_part section_padding">
        <div class="order_boxes">
          <div class="row">
            <div class="col-lg-6 col-lx-4">
              <div class="booking-info">
                <h4 class="text-center pb-4" style="text-transform: uppercase;">Thông Tin Đơn Hàng
                </h4>
                <table class="table">
                  <tr>
                    <td>Mã đơn</td>
                    <td> : {{ $booking->booking_number }}</td>
                  </tr>
                  <tr>
                    <td>Phim</td>
                    <td> : {{ $booking->show->movie->title }}</td>
                  </tr>
                  <tr>
                    <td>Suất chiếu</td>
                    <td> : {{ $booking->show->timeSlot->time_start . '-' .$booking->show->timeSlot->time_end  }}</td>
                  </tr>
                  <tr>
                    <td>Phòng chiếu</td>
                    <td> : {{ $booking->show->room->name }}</td>
                  </tr>
                  <tr>
                    <td>Ngày chiếu</td>
                    <td> : {{ Helpers::formatDate( $booking->show->date) }}</td>
                  </tr>
                  <tr>
                    <td>Ngày tạo đơn</td>
                    <td> : Ngày {{ $booking->created_at->format('d/m/Y') }} lúc
                      {{ $booking->created_at->format('g : i a') }}</td>
                  </tr>
                  <tr>
                    <td>Số lượng vé</td>
                    <td> : {{ $booking->tickets->count() }} vé</td>
                  </tr>

                  <tr>
                    <td>Trạng thái</td>
                    <td> : {!! Helpers::displayStatusBooking($booking->status) !!}</td>
                  </tr>

                  <tr>
                    <td>Tổng số tiền</td>
                    <td> : <strong>{{ Helpers::formatCurrency($booking->amount) }}</strong></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="col-lg-6 col-lx-4">
              <div class="shipping-info">
                <h4 class="text-center pb-4" style="text-transform: uppercase;">Thông Tin Người Đặt
                </h4>
                <table class="table">
                  <tr class="">
                    <td>Họ tên: </td>
                    <td> : {{ $booking->user->fullname }}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td> : {{ $booking->email }}</td>
                  </tr>
                  <tr>
                    <td>Số điện thoại</td>
                    <td> : {{ $booking->telephone }}</td>
                  </tr>
                
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      @endif
    </div>
  </div>
  <div class="card shadow my-4">
    <div class="card-header py-3">
      <h6 class="mt-2 font-weight-bold text-primary float-left">Danh sách vé</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTableCategory" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã vé</th>
              <th>Số ghế</th>
              <th>Loại ghế</th>
              <th>Giá</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($booking->tickets as $ticket)
            <tr>
              <td>{{ $ticket->ticket_id }}</td>
              <td>{{ $ticket->seat->name }}</td>
              <td>{{  $ticket->seat->typeSeat->name }}</td>
              <td>{{ Helpers::formatCurrency($ticket->price) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection