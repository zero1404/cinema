<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('shop.home') }}">ABCBOOK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <form class='nav-search' method='get' action="{{ route('shop.product-search') }}">
            <input name='keyword' class="form-control form-search" type="text" placeholder="Nhập từ khoá tìm kiếm..." />
            <input type="submit" style="display:none" />
        </form>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('shop.home') }}" class="nav-link">Trang Chủ</a></li>

                <x-Shop.Shared.CategoryMenu :categories="Helpers::getListMenuCategory()" />
                <li class="nav-item"><a href="{{ route('shop.contact') }}" class="nav-link">Liên Hệ</a></li>
                <li class="nav-item cta cta-colored">
                    <a id="cart_count" href="{{ route('shop.cart') }}" class="nav-link">
                        <span class="icon-shopping_cart"></span>
                        @guest
                            [0]
                        @else
                            [{{ Helpers::getCartCount() }}]
                        @endguest
                    </a>
                </li>
                <li class="nav-item cta cta-colored dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><span
                            class="icon-user mr-2"></span>{{ Auth::check() ? Auth::user()->fullname : 'Tài khoản' }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @guest
                            <a class="dropdown-item" href="{{ route('shop.user-login') }}">Đăng nhập</a>
                            <a class="dropdown-item" href="{{ route('shop.user-register') }}">Đăng ký</a>
                        @else
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'employee')
                                <a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('shop.list-ordered') }}">Đơn đặt hàng</a>
                            <a class="dropdown-item" href="{{ route('shop.profile') }}">Thông tin</a>
                            <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal"
                                data-target="#modalLogout">Đăng Xuất</a>
                        @endguest
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
