@extends('shop.layouts.app')
@section('title', 'Kết quả tìm kiếm cho từ khoá: {{ $keyword }}')

@section('content')
<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/breadcrumb.jpeg') }}');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('shop.home') }}">Trang
                            chủ</a></span>
                    <span class="mr-2"><a href="{{ route('shop.product-list') }}">Tìm Kiếm</a></span>
                    <span></span>
                </p>
                <h1 class="mb-0 bread">{{ $keyword }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="filter__item">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Sắp xếp</span>
                        <form method="get" action="">
                            <input type="hidden" name="keyword" value="{{ $keyword }}" />
                            @if ($paginate != 8)
                            <input type="hidden" name="paginate" value="{{ $paginate }}" />
                            @endif
                            <select class='form-control form-filter' id="sort-product" name="sort"
                                onchange="this.form.submit()">
                                @foreach (Helpers::getSortList() as $value)
                                <option value="{{ $value[0] }}" {{ $value[0]==$sort ? 'selected' : '' }}>
                                    {{ $value[1] }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 filter__found">
                    <h6>Tìm thấy <span>{{ count($products) }}</span> sản phẩm</h6>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Số sản phẩm hiển thị</span>
                        <form method="get" action="">
                            <input type="hidden" name="keyword" value="{{ $keyword }}" />
                            @if ($sort != 'new')
                            <input type="hidden" name="sort" value="{{ $sort }}" />
                            @endif
                            <select class='form-control form-filter' id="paginate-product" name="paginate"
                                onchange="this.form.submit()">
                                @foreach (Helpers::getPaginateList() as $value)
                                <option value="{{ $value }}" {{ $value==$paginate ? 'selected' : '' }}>
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if (count($products) == 0)
            <div class="container d-flex justify-content-center">
                <h3 class='py-3'>Không tìm thấy sách cho từ khoá: {{ $keyword }}</h3>
            </div>
            @else
            @foreach ($products as $product)
            <x-Shop.Product.Item :product="$product" />
            @endforeach
            @endif
        </div>
        {{ $products->appends($_GET)->links('shop.layouts.pagination') }}
    </div>
    @if (!$products || count($products) == 0)
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Có thể bạn thích</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach (Helpers::getRandomProduct() as $product)
                <x-Shop.Product.Item :product="$product" />
                @endforeach
            </div>
        </div>
    </section>
    @endif
</section>
@endsection