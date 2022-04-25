@extends('shop.layouts.app')
@section('title', 'Trang Chủ')

@section('content')

    <section class="ftco-section" style="padding-bottom: 10px !important;">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading" style="font-size: 28px; font-weight: bold">Sách Bán Chạy</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($productsHot as $product)
                    <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="ftco-section" style="padding-top: 10px !important;">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <span class="subheading" style="font-size: 28px; font-weight: bold">Sách Mới</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" id="product-list">
                @foreach ($products as $product)
                    <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
            <div class="text-center"><button class="see-more btn btn-primary mx">Xem Thêm</button></div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(function() {
            var pageNumber = 2;
            $(".see-more").click(function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'get',
                    url: `${window.location.origin}/?page= + ${pageNumber}`,
                    success: function(response) {
                        pageNumber += 1;
                        $("#product-list").append(response);
                        contentWayPoint();
                    },
                    error: function(error) {
                        //console.log(error.responseJSON.message)
                    },
                })
            });
        });
    </script>
@endpush
