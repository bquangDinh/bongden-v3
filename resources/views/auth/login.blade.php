@extends('layouts.main')

@section('title')
Bóng Đèn
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/auth.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
@endsection

@section('content')
<div style="margin-top: 100px;" class="d-none d-lg-block">

</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2 col-sm-1">

    </div>
    <div class="col-md-8 col-sm-9">
      <div class="sign-in-up-container shadow-hover">
        <div class="row">
          <div class="col-md-7 d-none d-md-block">
            <div class="account-cover d-flex justify-content-center align-items-center">
              <img src="{{ URL::asset('sources/images/webpage/loginpage/login.png') }}" id="login-cover">
              <img src="{{ URL::asset('sources/images/webpage/loginpage/register.png') }}" id="register-cover" style="display: none">
            </div>
          </div>
          <div class="col-md-5 col-12">
            <div class="account-form" id="login-form">
              <div class="title">
                <span>Đăng Nhập</span>
              </div>
              <form class="form" method="POST" action="{{ route('bongden_login') }}">
                @csrf
                @if(Request::has('previous'))
                  <input type="text" name="previous" value="{{ Request::get('previous') }}" style="display: none">
                @else
                  <input type="text" name="previous" value="{{ URL::previous() }}" style="display: none">
                @endif
                @if ($errors->has('auth'))
                <div class="error-message">
                  {{ $errors->first('auth') }}
                </div>
                @endif
                <div class="form-group">
                  <div class="row">
                    <div class="col-3">
                      <div class="form-gr-left">
                        <i class="fas fa-envelope"></i>
                      </div>
                    </div>
                    <div class="col-8">
                      <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-3">
                      <div class="form-gr-left">
                        <i class="fas fa-key"></i>
                      </div>
                    </div>
                    <div class="col-8">
                      <input id="password" type="password" placeholder="Mật Khẩu" name="password" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-12">
                      <button type="submit" name="submit">Đăng Nhập</button>
                    </div>
                </div>
              </form>
              <button type="button" id="sign-up-btn">Tạo tài khoản <i class="fas fa-arrow-circle-right"></i></button>
            </div>
          </div>

          <div class="account-form" id="register-form" style="display: none">
            <div class="title" style="top: 30px">
              <span>Đăng Ký</span>
            </div>
            <form class="form" method="POST" action="{{ route('bongden_register') }}">
              @csrf

              @if ($errors->has('email'))
              <div class="error-message">
                {{ $errors->first('email') }}
              </div>
              @endif
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div class="form-gr-left">
                      <i class="fas fa-envelope"></i>
                    </div>
                  </div>
                  <div class="col-8">
                    <input id="register-email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                </div>
              </div>

              @if ($errors->has('name'))
              <div class="error-message">
                {{ $errors->first('name') }}
              </div>
              @endif
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div class="form-gr-left">
                      <i class="fas fa-user"></i>
                    </div>
                  </div>
                  <div class="col-8">
                    <input id="register-name" type="text" placeholder="Họ Tên" name="name" required>
                  </div>
                </div>
              </div>

              @if ($errors->has('birthYear'))
              <div class="error-message">
                {{ $errors->first('birthYear') }}
              </div>
              @endif
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div class="form-gr-left">
                      <i class="fas fa-birthday-cake"></i>
                    </div>
                  </div>
                  <div class="col-8">
                    <input id="register-birthyear" type="text" placeholder="Năm Sinh" name="birthYear" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <input type="radio" name="gender" id="male-radio" value="male" checked>
                <input type="radio" name="gender" id="female-radio" value="female">
                <div class="sex-grid">
                  <div class="male sex-radio is-checked d-flex justify-content-center align-items-center">
                    <i class="fas fa-male"></i>
                  </div>
                  <div class="female sex-radio d-flex justify-content-center align-items-center">
                    <i class="fas fa-female"></i>
                  </div>
                </div>
              </div>

              @if ($errors->has('password'))
              <div class="error-message">
                {{ $errors->first('password') }}
              </div>
              @endif
              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div class="form-gr-left">
                      <i class="fas fa-key"></i>
                    </div>
                  </div>
                  <div class="col-8">
                    <input id="register-password" type="password" placeholder="Mật Khẩu" name="password" required autocomplete="new-password">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-3">
                    <div class="form-gr-left">
                      <i class="fas fa-key"></i>
                    </div>
                  </div>
                  <div class="col-8">
                    <input id="password-confirm" type="password" placeholder="Xác Nhận" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-12">
                    <button type="submit" name="submit" id="register-btn">Đăng Ký</button>
                  </div>
              </div>
            </form>
            <button type="button" id="sign-in-btn"><i class="fas fa-arrow-circle-left"></i> Đăng Nhập</button>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-1">

  </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ URL::asset('js/auth.js') }}"></script>
@endsection
