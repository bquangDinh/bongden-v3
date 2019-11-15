<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
      @yield('title')
    </title>

    <link rel="stylesheet" href="{{ URL::asset('css/vendor/bootstrap.min.css') }}">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('css/vendor/hamburgers.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/vendor/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>

    <link rel="stylesheet" href="{{ URL::asset('css/layouts/main.css') }}">

    @yield('css')
  </head>
  <body class="light">
    <!-- For mobile -->
    <header class="header-mobile d-block d-lg-none">
      <div class="header-mobile__bar">
        <div class="bd-name">
          <a href="/">BÓNG ĐÈN</a>
        </div>
        <div class="header-mobile-inner">
          <button type="button" class="hamburger hamburger--spring js-hamburger">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>

      <nav class="navbar-mobile">
        <ul class="navbar-mobile__list list-unstyled">
          <li>
            <a href="/">TRANG CHỦ</a>
          </li>
          <li>
            <a href="/about_us">CHÚNG MÌNH</a>
          </li>
          <li>
            <a href="/forum">THẢO LUẬN</a>
          </li>
          @if(Auth::check())
          <li>
            <a href="/user">TRANG CÁ NHÂN</a>
          </li>
          @else
          <li>
            <a href="/bongden_login">TÀI KHOẢN</a>
          </li>
          @endif
        </ul>
      </nav>
    </header>

    <form id="search-field" method="POST" action="{{ route('search') }}" role="search">
        {{ csrf_field() }}
        <input type="text" id="search-field__content" name="query" placeholder="Tìm kiếm bài viết..." spellcheck="false"/>
        <button type="button" id="search-field-close-btn">
          <i class="fas fa-times"></i>
        </button>
        <button type="submit" name="submit" style="visibility: hidden"></button>
    </form>

    <div class="page-wrapper container-fluid">
      <!-- NAVIGATION BAR -->
      <!-- For desktop -->
      <aside class="d-none d-lg-block navbar-desktop">
        <nav class="navbar navbar-expand-sm">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="/" class="nav-link nav-btt">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a href="/about_us" class="nav-link nav-btt remark" data-rm-type="update">Chúng mình</a>
            </li>
            <li class="nav-item">
              <a href="/forum" class="nav-link nav-btt">Thảo luận</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link nav-btt remark" data-rm-type="dev"><span class="badge badge-danger">Dev Mode</span></a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <div class="pretty p-switch p-fill" id="dark-switch">
                <input type="checkbox" id="dark-switch-input"/>
                <div class="state">
                  <label>Chế độ tối</label>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-right-item" id="search-btn">
                <i class="fas fa-search"></i>
              </button>
            </li>
            <li class="nav-item">
              @if(Auth::check())
              <img src="{{ Auth::user()->avatarURL }}" id="user-avatar" data-usn="{{ Auth::user()->name }}">
              @else
              <a class="nav-right-item" href="{{ route('bongden_login') }}" id="login-redirect">
                <i class="fas fa-sign-in-alt"></i>
              </a>
              @endif
            </li>
          </ul>
        </nav>
      </aside>
    </div>

    <div class="main-content">
      @yield('content')
    </div>

    <script src="{{ URL::asset('js/vendor/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/vendor/popper.min.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/vendor/sweetalert2.min.js') }}" charset="utf-8"></script>

    <script src="{{ URL::asset('js/layouts/main.js') }}" charset="utf-8"></script>

    @yield('js')
  </body>
</html>
