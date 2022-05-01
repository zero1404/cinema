    <!-- ==========Header-Section========== -->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="{{ route('cinema.home')}}">
                        <img src="{{ asset('cinema/images/logo/logo.png') }}" alt="logo">
                    </a>
                </div>
                <ul class="menu">
                    <li>
                        <a href="{{ route('cinema.home')}}" class="{{Route::currentRouteName() == 'cinema.home' ? 'active' : ''}}">Trang Chủ</a>
                    </li>
                    <li>
                        <a href="{{ route('cinema.movie.list') }}" class="{{Route::currentRouteName() == 'cinema.movie.list' ? 'active' : ''}}">Phim</a>
                    </li>
                    <li>
                        <a href="{{ route('cinema.about') }}" class="{{Route::currentRouteName() == 'cinema.about' ? 'active' : ''}}">Giới Thiệu</a>
                    </li>
                    <li>
                        <a href="{{ route('cinema.contact') }}" class="{{Route::currentRouteName() == 'cinema.contact' ? 'active' : ''}}">Liên Hệ</a>
                    </li>

                   @guest
                   <li class="header-button pr-0">
                    <a href="{{ route('cinema.auth.register') }}">Đăng Ký</a>
                    </li> 
                    <li class="header-button pr-0">
                        <a href="{{ route('cinema.auth.login') }}">Đăng Nhập</a>
                    </li> 
                    @endguest

                    @auth
                        <li>
                            <a href="{{ route('cinema.profile') }}" class="{{Route::currentRouteName() == 'cinema.contact' ? 'active' : ''}}">{{ Auth::user()->fullname }}</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"> Đăng xuất</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </ul>
                <div class="header-bar d-lg-none">
					<span></span>
					<span></span>
					<span></span>
				</div>
            </div>
        </div>
    </header>
    <!-- ==========Header-Section========== -->