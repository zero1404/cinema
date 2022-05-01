@extends('cinema.layouts.auth')
@section('title', 'Đăng Ký')

@section('content')
    <!-- ==========Sign-In-Section========== -->
    <section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
      <div class="container">
          <div class="padding-top padding-bottom">
              <div class="account-area">
                  <div class="section-header-3">
                      <h2 class="title">Đăng Ký</h2>
                  </div>
                  <form class="account-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="last_name">Họ<span>*</span></label>
                        <input type="text" name="last_name" class="@error('last_name') is-invalid @enderror" placeholder="Nhập họ" id="last_name" required>
                      </div>
                      @error('last_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      
                      <div class="form-group">
                        <label for="first_name">Tên<span>*</span></label>
                        <input type="text" name="first_name" class="@error('first_name') is-invalid @enderror" placeholder="Nhập tên" id="first_name" required>
                      </div>
                      @error('first_name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                      <div class="form-group">
                        <label for="telephone">Số điện thoại<span>*</span></label>
                        <input type="tel" name="telephone" class="@error('telephone') is-invalid @enderror" placeholder="Nhập số điện thoai" id="telephone" required>
                      </div>
                      @error('telephone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror

                      <div class="form-group">
                          <label for="email">Email<span>*</span></label>
                          <input type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Nhập email" id="email" required>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      <div class="form-group">
                          <label for="password">Mật khẩu<span>*</span></label>
                          <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="********" id="password" required>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="form-group">
                            <label for="password">Nhập Lại Mật khẩu<span>*</span></label>
                            <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="********" id="password" required>
                          </div>
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      <div class="form-group text-center">
                          <input type="submit" value="Đăng Ký">
                      </div>
                  </form>
                  <div class="option">
                      Đã có tài khoản? <a href="{{ route('cinema.auth.login')}}">Đăng nhập ngay</a>
                  </div>
                  <div class="or"><span>Or</span></div>
                  <ul class="social-icons">
                      <li>
                          <a href="#">
                              <i class="fab fa-facebook-f"></i>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="active">
                              <i class="fab fa-twitter"></i>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <i class="fab fa-google"></i>
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
  </section>
  <!-- ==========Sign-In-Section========== -->
@endsection