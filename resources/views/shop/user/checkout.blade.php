@extends('shop.layouts.app')
@section('title', 'Thanh toán')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/breadcrumb.jpeg') }}');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('shop.home') }}">Trang
                            Chủ</a></span>
                    <span>Thanh Toán</span>
                </p>
                <h1 class="mb-0 bread">Thanh Toán</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <form action="#" class="billing-form">
                    <h3 class="mb-4 billing-heading">Chi tiết thanh toán</h3>
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname">Họ:</label>
                                <input type="text" name="lastname" class="form-control" placeholder=""
                                    value="{{ $user->lastname }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname">Tên:</label>
                                <input type="text" name="firstname" class="form-control" placeholder=""
                                    value="{{ $user->firstname }}">
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Tỉnh: </label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="province" id="province" class="form-control">
                                        <option value="">Chọn tỉnh</option>
                                        @foreach (Helpers::getAllProvince() as $province)
                                        <option value="{{ $province->id }}" @if($user->address) {{ $user->address &&
                                            $province->id == $user->address->province->id ? ' selected' : '' }}
                                            @endif
                                            >
                                            {{ $province->name_with_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Thành phố/Quận: </label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="district" id="district" class="form-control">
                                        <option value="">Chọn thành phố/quận</option>
                                        @if($user->address)
                                        @foreach (Helpers::getDistricts($user->address->province->id) as $district)
                                        <option value="{{ $district->id }}" @if($user->address) {{ $district->id ==
                                            $user->address->district->id ? ' selected="selected"' : '' }} @endif>
                                            {{ $district->name_with_type }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Phường/Xã: </label>
                                <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="ward" id="ward" class="form-control">
                                        <option value="">Chọn phường xã</option>
                                        @if ($user->address)
                                        @foreach (Helpers::getWards($user->address->district->id) as $ward)
                                        <option value="{{ $ward->id }}" {{ $ward->id == $user->address->ward->id ? '
                                            selected' : '' }}>
                                            {{ $ward->name_with_type }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Địa chỉ: </label>
                                <input type="text" name="address" class="form-control"
                                    placeholder="Nhập số nhà và tên đường"
                                    value="@if($user->address){{ $user->address->address }} @endif">
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" name="telephone" class="form-control" placeholder=""
                                    value="{{ $user->telephone }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email:</label>
                                <input type="text" name="email" class="form-control" placeholder=""
                                    value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="emailaddress">Ghi chú:</label>
                                <textarea name="note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form><!-- END -->
            </div>
            <div class="col-xl-5">
                <div class="row mt-5 pt-3">
                    <div class="col-md-12 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Giỏ hàng</span>
                                <span class="badge badge-primary badge-pill mr-3">{{ $carts->count }}</span>
                            </h3>
                            <ul class="list-group mb-3">
                                @foreach ($carts->items as $item)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{ $item->product->title }}</h6>
                                        <small class="text-muted">Số lượng: {{ $item->quantity }}</small>
                                    </div>
                                    <span class="text-muted">{{ Helpers::formatCurrency($item->quantity *
                                        $item->product->price) }}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                            <h3 class="billing-heading ml-3 mt-3 mb-3">Tổng giỏ hàng</h3>
                            <div class="ml-2">
                                <p class="d-flex">
                                    <span>Tổng tiền hàng</span>
                                    <span id="subtotal">{{ Helpers::formatCurrency($carts->total) }}</span>
                                </p>
                                <p class="d-flex">
                                    <span>Phí vận chuyển</span>
                                    <span>0đ</span>
                                </p>
                                <p class="d-flex">
                                    <span>Giảm giá</span>
                                    <span>{{ Helpers::formatCurrency($discount_money) }}</span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Tổng số tiền</span>
                                    <span>{{ Helpers::formatCurrency($carts->total - $discount_money) }}</span>
                                </p>
                                <p>
                                    <a href="javascript:void(0)" id="order" class="btn btn-primary py-3 px-4">Thanh
                                        Toán</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section> <!-- .section -->
@endsection