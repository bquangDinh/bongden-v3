<!DOCTYPE html>
<html lang="en">

<head
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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

  <title>
    @yield('title')
  </title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ URL::asset('css/vendor/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">
  <link rel="stylesheet" href="{{ URL::asset('css/userpage/user_layout.css') }}">
  @yield('css')

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="far fa-lightbulb"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bóng Đèn</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="/user">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Người dùng
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="far fa-newspaper"></i>
          <span>Bài viết</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Bài viết:</h6>
            @if(Auth::user()->hasPermission('write_article'))
            <a class="collapse-item" href="{{ route('show_creating_article_page') }}">Tạo bài viết</a>
            @endif
            <a class="collapse-item" href="{{ route('show_article_list_page') }}">Bài viết của tôi</a>
            <a class="collapse-item" href="{{ route('show_writing_article_rule_page') }}">Quy định viết bài</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="far fa-comment-alt"></i>
          <span>Thảo luận</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Thảo luận:</h6>
            @if(Auth::user()->hasPermission('write_discussion'))
            <a class="collapse-item" href="{{ route('show_creating_discussion_page') }}">Tạo thảo luận</a>
            @endif
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Bóng Đèn Team
      </div>

      <!-- Nav Item - Pages Collapse Menu -->

      <!--Manager-->
      @if(Auth::user()->hasRole('manager'))
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Quản lý</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý:</h6>
            <a class="collapse-item" href="{{ route('show_user_staticstic_page') }}">Thống kê</a>
          </div>
        </div>
      </li>
      @endif

      <!--Manager-->
      @if(Auth::user()->hasRole('content_executive'))
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Nội dung</span>
        </a>
        <div id="collapsePages1" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Nội dung:</h6>
            <a class="collapse-item" href="{{ route('show_article_approving_page') }}">Phê duyệt bài viết</a>
          </div>
        </div>
      </li>
      @endif


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group d-none">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1 d-none">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter" id="notification-count" data-current-count="{{ count(Auth::user()->unreadNotifications) }}">
                  {{ count(Auth::user()->unreadNotifications) }}
                </span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Thông báo
                </h6>
                <div id="notification-list">
                  @foreach(Auth::user()->unreadNotifications as $key => $notification)
                  @if($key < 4)
                  <a class="dropdown-item d-flex align-items-center animated lightSpeedIn" href="{{ $notification->url }}">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="{{ $notification->actor->avatarURL }}" alt="user avatar">
                    </div>
                    <div class="font-weight-bold">
                      <div class="text-truncate">{{ $notification->message }}</div>
                      <div class="small text-gray-500">{{ $notification->actor->name }}</div>
                    </div>
                  </a>
                  @endif
                  @endforeach
                </div>

                <a class="dropdown-item text-center small text-gray-500" href="{{ route('show_user_notification_page') }}">Đọc tất cả</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" style="object-fit: cover" src="{{ Auth::user()->avatarURL }}" id="avatar-top-bar">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('show_user_profile_page') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Hồ sơ
                </a>
                <a class="dropdown-item" href="{{ route('show_user_changing_password_page') }}">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Đổi mật khẩu
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Đăng xuất
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          @if(Auth::check())
          @if(!Auth::user()->verified_email)
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Thông báo !</strong> Email của bạn vẫn chưa được xác thực, nhấn vào <a href="{{ route('show_verify_email_page') }}">đây</a> để xác thực
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @endif
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">
            @yield('content-title')
          </h1>

          @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Bóng Đèn | Copyright &copy; Sb Admin 2</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn đăng xuất ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Các tác vụ đang làm sẽ không được lưu lại. Nhấn 'Đăng xuất' để thoát.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
          <a class="btn btn-primary" href="{{ route('bongden_logout') }}">Đăng xuất</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ URL::asset('js/vendor/jquery-3.4.1.min.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/vendor/popper.min.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}" charset="utf-8"></script>
  <script src="{{ URL::asset('js/vendor/sweetalert2.min.js') }}" charset="utf-8"></script>
  <script src="https://js.pusher.com/3.1/pusher.min.js" charset="utf-8"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ URL::asset('js/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>
  <script src="https://unpkg.com/tippy.js@5"></script>
  <script src="{{ URL::asset('js/layouts/userpage.js') }}" charset="utf-8"></script>
  @yield('js')
</body>

</html>
