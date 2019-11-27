<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="science, camping, event, research, education">
    <meta name="description" content="Bóng Đèn là tổ chức khoa học dành cho học sinh cấp 2 với mục tiêu mang lại kiến thức khoa học theo cách thú vị và nhiều màu sắc hơn là những kiến thức khô khan trong sách giáo khoa. Còn đợi gì nữa mà không tham gia với tụi mình.">
    <title>
      @yield('title')
    </title>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ URL::asset('sources/images/protected/icon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ URL::asset('sources/images/protected/icon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ URL::asset('sources/images/protected/icon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ URL::asset('sources/images/protected/icon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ URL::asset('sources/images/protected/icon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ URL::asset('sources/images/protected/icon/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ URL::asset('sources/images/protected/icon/mstile-144x144.png') }}" />
    <meta name="msapplication-square70x70logo" content="{{ URL::asset('sources/images/protected/icon/mstile-70x70.png') }}" />
    <meta name="msapplication-square150x150logo" content="{{ URL::asset('sources/images/protected/icon/mstile-150x150.png') }}" />
    <meta name="msapplication-wide310x150logo" content="{{ URL::asset('sources/images/protected/icon/mstile-310x150.png') }}" />
    <meta name="msapplication-square310x310logo" content="{{ URL::asset('sources/images/protected/icon/mstile-310x310.png') }}" />

    <link rel="stylesheet" href="{{ URL::asset('css/vendor/bootstrap.min.css') }}">

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('css/vendor/hamburgers.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/vendor/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/vendor/material-scrolltop.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">

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
            <a href="/forum" data-rm-type="update" class="remark">THẢO LUẬN</a>
          </li>
          @if(Auth::check())
          <li>
            <a href="/user">TRANG CÁ NHÂN</a>
          </li>
          <li>
            <a href="/bongden_logout">ĐĂNG XUẤT</a>
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
      <button class="material-scrolltop" type="button"></button>
      <div id="user-profile">
        <button type="button" id="us-pr-close">
          <i class="fas fa-times"></i>
        </button>
        <div class="row d-flex justify-content-center mt-5">
          <img src="https://www.pcgamesn.com/wp-content/uploads/2019/04/Astroneer-My-base-900x506.jpg" alt="user logo" id="us-pr-logo">
        </div>
        <div class="mt-3 w-100" id="us-pr-name">
          Bui Quang Dinh
        </div>
        <div class="mt-3 w-100 d-flex justify-content-center">
          <div id="us-pr-last-achieve" class="w-75">
            <i class="fab fa-medapps medal"></i>
            <i class="fab fa-medapps medal"></i>
            <i class="fab fa-medapps medal"></i>
            <i id="us-pr-last-achieve-name">Nhà thông thái</i>
            <i class="fab fa-medapps medal"></i>
            <i class="fab fa-medapps medal"></i>
            <i class="fab fa-medapps medal"></i>
          </div>
        </div>
        <div class="mt-3 row w-100">
          <div class="col-6">
            <div class="us-pr-p-container d-flex justify-content-center">
              <div>
                <span class="us-pr-p-title">
                  Số bài viết
                </span>
                <div id="us-pr-p-ar-count">
                  10
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="us-pr-p-container d-flex justify-content-center">
              <div>
                <span class="us-pr-p-title">
                  Số thảo luận
                </span>
                <div id="us-pr-p-dis-count">
                  5
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3 row w-100">
          <div class="col-6">
            <div class="us-pr-p-container d-flex justify-content-center">
              <div>
                <span class="us-pr-p-title">
                  Cấp độ
                </span>
                <div id="us-pr-p-level-count">
                  10
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="us-pr-p-container d-flex justify-content-center">
              <div>
                <span class="us-pr-p-title">
                  Kinh nghiệm
                </span>
                <div id="us-pr-p-exp-count">
                  5
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @yield('content')
    </div>

    <footer class="container-fluid mt-3">
      <div class="row">
        <div class="col-md-4 col-12">
          <div class="panel d-flex justify-content-center align-items-center">
            <div class="panel__inner ml-3">
              <h3 class="f-title">
                Về Bóng Đèn
              </h3>
              <p class="f-content mt-3">
                Sân chơi khoa học ứng dụng dành cho lứa tuổi 11-15.
Like fanpage để cập nhật thông tin Khoa học thú vị hằng ngày!
              </p>
              <div class="row">
                <div class="col-6">
                  <h5 class="f-title">
                    Huế
                  </h5>
                  <a href="https://www.facebook.com/bongdencamp/" target="_blank" class="mt-3 share-page-btn">
                    <i class="fab fa-facebook"></i>
                  </a>
                </div>
                <div class="col-6">
                  <h5 class="f-title">
                    Đà Nẵng
                  </h5>
                  <a href="https://www.facebook.com/bongdendn/" target="_blank" class="mt-3 share-page-btn">
                    <i class="fab fa-facebook"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="panel d-flex justify-content-center align-items-center">
            <div class="panel__inner">
              <h3 class="f-title">Liên hệ</h3>
              <div class="row">
                <div class="col-md-6 col-12 mt-3">
                  <h5 class="f-title">Huế</h5>
                  <div class="mt-3">
                    <div class="f-content">
                      <a href="">Dương Anh Thi</a>
                      <h6>thybabie572@gmail.com</h6>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="f-content">
                      <a href="#">Hoàng Thanh Nga</a>
                      <h6>htnga810@gmail.com</h6>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-12 mt-3">
                  <h5 class="f-title">Đà Nẵng</h5>
                  <div class="mt-3">
                    <div class="f-content">
                      <a href="#">Phan Hồ Khánh Linh</a>
                      <h6>linhkhanhhophan@gmail.com</h6>
                    </div>
                  </div>
                  <div class="mt-3">
                    <div class="f-content">
                      <a href="#">Trần Phú Thức</a>
                      <h6>lewisthuc@gmail.com</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-12">
          <div class="panel d-flex justify-content-center align-items-center">
            <div class="panel__inner">
              <img src="{{ URL::asset('sources/images/protected/icon/mstile-310x310.png') }}" alt="logo" id="bd-logo">
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="{{ URL::asset('js/vendor/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/vendor/popper.min.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/vendor/sweetalert2.min.js') }}" charset="utf-8"></script>
    <script src="https://unpkg.com/tippy.js@5"></script>
    <script src="{{ URL::asset('js/vendor/material-scrolltop.js') }}"></script>

    <script src="{{ URL::asset('js/layouts/main.js') }}" charset="utf-8"></script>

    @yield('js')
  </body>
</html>
