@extends('shop.layouts.app')
@section('title', 'Chi tiết đơn đặt hàng')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto py-5">
                <article class="card">
                    <header class="card-header cart-empty text-white text-uppercase"> Chi Tiết Đơn Đặt Hàng </header>
                    <div class="card-body">
                        <article class="card">
                            <div class="card-body row">
                                <div class="col"> <strong>Mã đơn hàng: </strong> <br>{{ $order->order_number }}
                                </div>
                                <div class="col"> <strong>Ngày đặt hàng:</strong> <br>
                                    {{ $order->created_at->format('d/m/Y') }} lúc
                                    {{ $order->created_at->format('g : i a') }} </div>
                                <div class="col"> <strong>Ngày giao hàng dự kiến:</strong> <br>
                                    @if ($order->status == 'cancel')
                                        -
                                    @else
                                        {{ $order->created_at->addDays('4')->format('d/m/Y') }}
                                    @endif
                                </div>
                                <div class="col"> <strong>Tổng tiền:</strong> <br>
                                    {{ Helpers::formatCurrency($order->total) }}</div>
                            </div>
                        </article>
                        <div class="track">
                            <div
                                class="step {{ $order->status == 'cancel' ? 'step-cancel' : '' }} {{ $order->status == 'delivering' || $order->status == 'done' || $order->status == 'new' || $order->status == 'accepted' ? ' active' : '' }}">
                                <span class="icon"> <i class="icon-spinner"></i>
                                </span> <span class="text">Đang Chờ Xác Nhận</span>
                            </div>
                            <div
                                class="step {{ $order->status == 'cancel' ? 'step-cancel' : '' }} {{ $order->status == 'delivering' || $order->status == 'done' || $order->status == 'accepted' ? ' active' : '' }}">
                                <span class="icon"> <i class="icon-check"></i>
                                </span> <span class="text">Đã Xác Nhận</span>
                            </div>
                            <div
                                class="step {{ $order->status == 'cancel' ? 'step-cancel' : '' }} {{ $order->status == 'delivering' || $order->status == 'done' ? 'active' : '' }}">
                                <span class="icon"> <i class="icon-truck"></i>
                                </span> <span class="text"> Đang Vận Chuyển</span>
                            </div>
                            <div
                                class="step {{ $order->status == 'cancel' ? 'step-cancel' : '' }} {{ $order->status == 'done' ? ' active' : '' }}">
                                <span class="icon"> <i
                                        class="{{ $order->status == 'cancel' ? 'icon-cancel' : 'icon-dropbox' }}"></i>
                                </span> <span
                                    class="text">{{ $order->status == 'cancel' ? 'Huỷ' : 'Đã Giao Hàng' }}</span>
                            </div>
                        </div>
                        <hr>
                        <p class="px-4">Giảm giá: {{ Helpers::formatCurrency($order->discount) }}</p>
                        <p class="px-4">Địa chỉ giao hàng: {{ $order->address }}</p>
                        <p class="px-4">Ghi chú: {{ $order->note == '' ? 'Không có' : $order->note }}</p>
                        <hr>
                        <ul class="row">
                            @foreach ($order->items as $item)
                                <li class="col-md-4">
                                    <figure class="itemside mb-3">
                                        <div class="aside"><img src="{{ $item->product->images }}"
                                                class="img-sm border">
                                        </div>
                                        <figcaption class="info align-self-center">
                                            <p class="title">{{ $item->product->title }}</p>
                                            <p class="text-muted mt-1 mb-1">Giá:
                                                {{ Helpers::formatCurrency($item->product->price * $item->quantity) }}</span>
                                            <p class="text-muted mt-1 mb-1">Số lượng: {{ $item->quantity }}</span>
                                        </figcaption>
                                    </figure>
                                </li>
                            @endforeach
                        </ul>
                        <hr> <a href="{{ route('shop.list-ordered') }}" class="btn btn-primary" data-abc="true"> <i
                                class="fa fa-chevron-left"></i>Quay lại</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
