@extends('shop.layouts.app')
@section('title', 'Đăng Nhập')

@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <!-- Basic login form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                    <div class="card-header cart-empty text-center justify-content-center">
                        <h3 class="fw-light mb-0" style="text-transform: uppercase;">Đăng Nhập</h3>
                    </div>
                    <div class="card-body">
                        <!-- Login form-->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="inputEmailAddress"
                                    type="email" name="email" placeholder="Nhập địa chỉ email" autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Form Group (password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPassword">Mật Khẩu:</label>
                                <input class="form-control @error('password') is-invalid @enderror" id="inputPassword"
                                    type="password" name="password" placeholder="Nhập mật khẩu" required
                                    autocomplete="current-password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Form Group (remember password checkbox)-->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox"
                                        name="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="rPasform-check-label" for="remembeswordCheck">Nhớ mật khẩu</label>
                                </div>
                            </div>
                            <!-- Form Group (login box)-->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="{{ route('password.request') }}">Quên mật khẩu</a>
                                <button class="btn btn-primary" type="submit">Đăng Nhập</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="{{ route('shop.user-register') }}">Chưa có tài khoản? Đăng ký!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
