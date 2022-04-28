<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
  <a class="navbar-brand me-lg-5" href="{{ route('dashboard.index') }}">
    <img class="navbar-brand-dark" src="{{ asset('admin/img/brand/light.svg') }}" alt="logo" />
    <img class="navbar-brand-light" src="{{ asset('admin/img/brand/dark.svg') }}" alt="logo" />
  </a>
  <div class="d-flex align-items-center">
    <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
  <div class="sidebar-inner px-4 pt-3">
    <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
      <div class="d-flex align-items-center">
        <div class="avatar-lg me-4">
          <img src="{{ Helpers::getUserAvatar(auth()->user()->avatar)}}"
            class="card-img-top rounded-circle border-white" alt="{{ auth()->user()->fullname }}">
        </div>
        <div class="d-block">
          <h2 class="h5 mb-3">{{ auth()->user()->fullname }}</h2>
          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutModal"
            class="btn btn-secondary btn-sm d-inline-flex align-items-center text-white">
            <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Đăng Xuất
          </a>
        </div>
      </div>

      <div class="collapse-close d-md-none">
        <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
          aria-expanded="true" aria-label="Toggle navigation">
          <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
    </div>

    <ul class="nav flex-column pt-3 pt-md-0">
      <li class="nav-item">
        <a href="{{ route('dashboard.index') }}" class="nav-link d-flex align-items-center">
          <span class="sidebar-icon">
            <img src="{{ asset('admin/img/brand/light.svg') }}" height="20" width="20" alt="Volt Logo">
          </span>
          <span class="mt-1 ms-1 sidebar-text">CINEMA</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'dashboard.index' ? 'active' : ''}}">
        <a href="{{route('dashboard.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
          </span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        CINEMA
      </div>
      <li class="nav-item {{Route::currentRouteName() == 'booking.index' ? 'active' : ''}}">
        <a href="{{route('booking.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </span>
          <span class="sidebar-text">Đơn đặt</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'show.index' ? 'active' : ''}}">
        <a href="{{route('show.index')}}" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          </span>
          <span class="sidebar-text">Lịch chiếu</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'room.index' ? 'active' : ''}}">
        <a href="{{route('room.index')}}" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
          </svg>
          </span>
          <span class="sidebar-text">Phòng chiếu</span>
        </a>
      </li>

      <li class="nav-item">
        <span class="nav-link d-flex justify-content-between align-items-center collapsed"
          data-bs-toggle="collapse" data-bs-target="#submenu-app" aria-expanded="false">
          <span>
            <span
              class="sidebar-icon">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg> 
          </span>
          <span class="sidebar-text">Ghế Ngồi</span> </span><span class="link-arrow"><svg
              class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg></span></span>
        <div class="multi-level collapse" role="list" id="submenu-app" aria-expanded="false" style="">
          <ul class="flex-column nav">

            <li class="nav-item {{Route::currentRouteName() == 'seat.index' ? 'active' : ''}}">
              <a class="nav-link" href="{{route('seat.index')}}">
                <span class="sidebar-text">Ghế</span>
              </a>
            </li>

            <li class="nav-item {{Route::currentRouteName() == 'type-seat.index' ? 'active' : ''}}">
              <a class="nav-link" href="{{route('type-seat.index')}}">
                <span class="sidebar-text">Loại Ghế</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'time-slot.index' ? 'active' : ''}}">
        <a href="{{route('time-slot.index')}}" class="nav-link">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          </span>
          <span class="sidebar-text">Khung Giờ</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        THÔNG TIN
      </div>

      <li class="nav-item {{Route::currentRouteName() == 'movie.index' ? 'active' : ''}}">
        <a href="{{ route('movie.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
            </svg>
          </span>
          <span class="sidebar-text">Phim</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'category.index' ? 'active' : ''}}">
        <a href="{{ route('category.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
              <path fill-rule="evenodd"
                d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                clip-rule="evenodd"></path>
            </svg>
          </span>
          <span class="sidebar-text">Danh mục</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'language.index' ? 'active' : ''}}">
        <a href="{{ route('language.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
            </svg>
          </span>
          <span class="sidebar-text">Ngôn ngữ</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'actor.index' ? 'active' : ''}}">
        <a href="{{ route('actor.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </span>
          <span class="sidebar-text">Diễn viên</span>
        </a>
      </li>
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        CHUNG
      </div>

      <li class="nav-item {{Route::currentRouteName() == 'user.index' ? 'active' : ''}}">
        <a href="{{ route('user.index')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </span>
          <span class="sidebar-text">Tài khoản</span>
        </a>
      </li>

      <li class="nav-item {{Route::currentRouteName() == 'dashboard.file-manager' ? 'active' : ''}}">
        <a href="{{ route('dashboard.file-manager')}}" class="nav-link">
          <span class="sidebar-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
            </svg>
          </span>
          <span class="sidebar-text">Quản Lý Tập Tin</span>
        </a>
      </li>

    </ul>
  </div>
</nav>