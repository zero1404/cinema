@extends('shop.layouts.app')
@section('title', 'Tất cả sách')

@section('content')
<section class="ftco-section">
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('shop/images/breadcrumb.jpeg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('shop.home') }}">Trang
                                Chủ</a></span>
                        @if (isset($category) && $category->parent != null)
                        <span><a href="{{ route('shop.product-by-category', $category->parent->slug) }}">{{
                                $category->parent->title }}</a></span>
                        @endif
                    </p>
                    <h1 class="mb-0 bread">{{ isset($category) ? $category->title : 'Sản Phẩm' }}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section" style="padding-top: 0px !important">
    <div class="container">
        <div class="filter__item">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Sắp xếp</span>
                        <form method="get" action="">
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
                <div class="col-lg-4 col-md-5">
                    <div class="filter__sort">
                        <span>Số sản phẩm hiển thị</span>
                        <form method="get" action="">
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
                <h3 class='py-3'>Danh sách trống</h3>
            </div>
            @else
            @foreach ($products as $product)
            <x-Shop.Product.Item :product="$product" />
            @endforeach
            @endif
        </div>
        {{ $products->appends($_GET)->links('shop.layouts.pagination') }}
    </div>
</section>
@endsection