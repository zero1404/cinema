@extends('cinema.layouts.auth')
@section('title', 'Đăng Nhập')

@section('content')
    <!-- ==========Sign-In-Section========== -->
    <section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
      <div class="container">
          <div class="padding-top padding-bottom">
              <div class="account-area">
                  <div class="section-header-3">
                      <h2 class="title">Đăng Nhập</h2>
                  </div>
                  <form class="account-form" method="POST" action="{{ route('login') }}">
                    @csrf
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
                      <div class="form-group checkgroup">
                          <input type="checkbox" name="remember"
                          id="remember" {{ old('remember') ? 'checked' : '' }}>
                          <label for="remember">Lưu đăng nhập</label>
                          <a href="{{ route('password.request') }}" class="forget-pass">Quên mật khẩu</a>
                      </div>
                      <div class="form-group text-center">
                          <input type="submit" value="Đăng Nhập">
                      </div>
                  </form>
                  <div class="option">
                      Chưa có tài khoản? <a href="{{ route('cinema.auth.register')}}">Đăng ký ngay</a>
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