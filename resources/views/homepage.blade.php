@extends('layouts.main')

@section('title')
Bóng Đèn
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/homepage.css') }}">
@endsection

@section('content')
<div class="triangle-layer d-lg-block d-none" id="particles-js">
  <div class="lowerside">

  </div>
</div>
<div class="article-section container-fluid">
  <div class="row d-flex justify-content-center">
    <div class="col-md-11 col-sm-11">
      <div class="article-section__inner">
        <!-- Lastest Article Section -->
        <div class="row">
          <div class="col-12">
            <div class="lastest-article-container w-100 mt-3">
              <div class="row no-gutters">
                <div class="col-md-7 col-12" style="position: relative">
                  <div class="cover">
                    <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423" alt="lastest article cover">
                  </div>
                </div>
                <div class="col-md-5 col-12">
                  <div class="article-info">
                    <span class="badge badge-success subject">
                      Astroneer
                    </span>
                    <span class="badge badge-success reading-time">
                      4 minutes 20 seconds
                    </span>
                    <div class="info">
                      <p class="title">
                        Discovering and enacting the path to safe artificial general intelligence. Discovering and enacting the path to safe artificial general intelligence.
                      </p>
                      <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                        <div class="avatar">
                          <img src="http://bongden.org/sources/images/logo.png" alt="author avatar">
                          <div class="user-level d-flex justify-content-center align-items-center">
                            <span>35</span>
                          </div>
                        </div>
                        <div class="name">
                          Bui Quang Dinh
                        </div>
                      </div>
                      <div class="description">
                        Something is awesome !!!!
                      </div>
                    </div>
                    <div class="read-more-section">
                      <button type="button">
                        Đọc thêm
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Three recent article section -->
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="article-container w-100">
              <div class="cover">
                <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423">
              </div>
              <div class="article-info">
                <span class="badge badge-success subject">
                  Astroneer
                </span>
                <span class="badge badge-success reading-time">
                  4 minutes 20 seconds
                </span>
                <div class="info">
                  <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                    <div class="avatar">
                      <img src="http://bongden.org/sources/images/logo.png" alt="author avatar">
                      <div class="user-level d-flex justify-content-center align-items-center">
                        <span>35</span>
                      </div>
                    </div>
                    <div class="name">
                      Bui Quang Dinh
                    </div>
                  </div>
                  <p class="title">
                    Hello World !!!
                  </p>
                  <p class="description">
                    Something is awesome !!!
                  </p>
                </div>
                <div class="read-more-section">
                  <button>Đọc thêm</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="article-container w-100">
              <div class="cover">
                <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423">
              </div>
              <div class="article-info">
                <span class="badge badge-success subject">
                  Astroneer
                </span>
                <span class="badge badge-success reading-time">
                  4 minutes 20 seconds
                </span>
                <div class="info">
                  <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                    <div class="avatar">
                      <img src="http://bongden.org/sources/images/logo.png" alt="author avatar">
                      <div class="user-level d-flex justify-content-center align-items-center">
                        <span>35</span>
                      </div>
                    </div>
                    <div class="name">
                      Bui Quang Dinh
                    </div>
                  </div>
                  <p class="title">
                    Discovering and enacting the path to safe artificial general intelligence.
                  </p>
                  <p class="description">
                    Something is awesome !!! Something is awesome !!! Something is awesome !!! Something is awesome !!! Something is awesome !!!
                  </p>
                </div>
                <div class="read-more-section">
                  <button>Đọc thêm</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="article-container w-100">
              <div class="cover">
                <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423">
              </div>
              <div class="article-info">
                <span class="badge badge-success subject">
                  Astroneer
                </span>
                <span class="badge badge-success reading-time">
                  4 minutes 20 seconds
                </span>
                <div class="info">
                  <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                    <div class="avatar">
                      <img src="http://bongden.org/sources/images/logo.png" alt="author avatar">
                      <div class="user-level d-flex justify-content-center align-items-center">
                        <span>35</span>
                      </div>
                    </div>
                    <div class="name">
                      Bui Quang Dinh
                    </div>
                  </div>
                  <p class="title">
                    Hello World !!!
                  </p>
                  <p class="description">
                    Something is awesome !!!
                  </p>
                </div>
                <div class="read-more-section">
                  <button>Đọc thêm</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Article List -->
        <div class="row">
          <div class="col-12">
            <h4 style="font-family: Comfortaa-Regular;" class="mt-5">Bài viết gần đây</h4>
            <div class="recent-article-list w-100">
              <div class="recent-article w-100 mt-3">
                <div class="row">
                  <div class="col-lg-2 d-lg-block d-none">
                    <!--Cover-->
                    <div class="cover w-100 d-flex justify-content-center align-items-center">
                      <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423">
                    </div>
                  </div>
                  <div class="col-lg-7 col-7">
                    <div class="d-flex justify-content-center align-items-center" style="height: 80px">
                      <a href="" class="title ml-3">
                        Discovering and enacting the path to safe artificial general intelligence.
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-5">
                    <div class="user-avatar-container w-100 d-flex align-items-center">
                      <div class="avatar">
                        <img src="http://bongden.org/sources/images/logo.png" alt="">
                        <div class="user-level d-flex justify-content-center align-items-center">
                          <span>35</span>
                        </div>
                      </div>
                      <div class="name">
                        Bùi Quang Đính
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="recent-article w-100 mt-3">
                <div class="row">
                  <div class="col-lg-2 d-lg-block d-none">
                    <!--Cover-->
                    <div class="cover w-100 d-flex justify-content-center align-items-center">
                      <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423">
                    </div>
                  </div>
                  <div class="col-lg-7 col-7">
                    <div class="d-flex justify-content-center align-items-center" style="height: 80px">
                      <a href="" class="title ml-3">
                        Discovering and enacting the path to safe artificial general intelligence.
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-5">
                    <div class="user-avatar-container w-100 d-flex align-items-center">
                      <div class="avatar">
                        <img src="http://bongden.org/sources/images/logo.png" alt="">
                        <div class="user-level d-flex justify-content-center align-items-center">
                          <span>35</span>
                        </div>
                      </div>
                      <div class="name">
                        Bùi Quang Đính
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="recent-article w-100 mt-3">
                <div class="row">
                  <div class="col-lg-2 d-lg-block d-none">
                    <!--Cover-->
                    <div class="cover w-100 d-flex justify-content-center align-items-center">
                      <img src="https://steamcdn-a.akamaihd.net/steam/apps/361420/ss_858b8bece04b753a6b35a009776a4de9dd6e0df7.1920x1080.jpg?t=1568684423">
                    </div>
                  </div>
                  <div class="col-lg-7 col-7">
                    <div class="d-flex justify-content-center align-items-center" style="height: 80px">
                      <a href="" class="title ml-3">
                        Discovering and enacting the path to safe artificial general intelligence.
                      </a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-5">
                    <div class="user-avatar-container w-100 d-flex align-items-center">
                      <div class="avatar">
                        <img src="http://bongden.org/sources/images/logo.png" alt="">
                        <div class="user-level d-flex justify-content-center align-items-center">
                          <span>35</span>
                        </div>
                      </div>
                      <div class="name">
                        Bùi Quang Đính
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <a href="" id="view-all-article">
              Xem toàn bộ <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="discussion-section container-fluid">
  <div class="row">
    <div class="col-md-3 col-sm-12">
      <div class="ds-left-panel d-flex justify-content-center align-items-center flex-column">
        <h4 style="font-family: Comfortaa-Regular">Thảo luận</h4>
        <a href="" id="redirect-discussion" class="btn mt-3">
          Xem tất cả
        </a>

      </div>
    </div>
    <div class="col-md-9 col-sm-12">
      <div class="row">
        <div class="col-md-6 col-12">
          <div class="new-discussion-container d-flex justify-content-center align-items-center">
            <div class="new-discussion-inner">
              <div class="user-avatar-container w-100 d-flex align-items-center mt-3 ml-3">
                <div class="avatar">
                  <img src="http://bongden.org/sources/images/logo.png">
                  <div class="user-level d-flex justify-content-center align-items-center">
                    <span>35</span>
                  </div>
                </div>
                <div class="name">
                  Bui Quang Dinh
                </div>
              </div>
              <span class="badge badge-secondary ds-type">FAQ</span>
              <div class="w-100 d-flex justify-content-center">
                <div class="w-75">
                  <p href="" class="ds-title">
                    How to make a link look like a button? How to make a link look like a button?
                  </p>
                </div>
              </div>
              <div class="control-container">
                <p class="ds-comment">
                36 comments
                </p>
                <a href="" class="btn redirect-ds-reading">
                  Đọc thêm
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="new-discussion-container d-flex justify-content-center align-items-center">
            <div class="new-discussion-inner">
              <div class="user-avatar-container w-100 d-flex align-items-center mt-3 ml-3">
                <div class="avatar">
                  <img src="http://bongden.org/sources/images/logo.png">
                  <div class="user-level d-flex justify-content-center align-items-center">
                    <span>35</span>
                  </div>
                </div>
                <div class="name">
                  Bui Quang Dinh
                </div>
              </div>
              <span class="badge badge-secondary ds-type">FAQ</span>
              <div class="w-100 d-flex justify-content-center">
                <div class="w-75">
                  <p href="" class="ds-title">
                    How to make a link look like a button? How to make a link look like a button?
                  </p>
                </div>
              </div>
              <div class="control-container">
                <p class="ds-comment">
                36 comments
                </p>
                <a href="" class="btn redirect-ds-reading">
                  Đọc thêm
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="new-discussion-container d-flex justify-content-center align-items-center">
            <div class="new-discussion-inner">
              <div class="user-avatar-container w-100 d-flex align-items-center mt-3 ml-3">
                <div class="avatar">
                  <img src="http://bongden.org/sources/images/logo.png">
                  <div class="user-level d-flex justify-content-center align-items-center">
                    <span>35</span>
                  </div>
                </div>
                <div class="name">
                  Bui Quang Dinh
                </div>
              </div>
              <span class="badge badge-secondary ds-type">FAQ</span>
              <div class="w-100 d-flex justify-content-center">
                <div class="w-75">
                  <p href="" class="ds-title">
                    How to make a link look like a button? How to make a link look like a button?
                  </p>
                </div>
              </div>
              <div class="control-container">
                <p class="ds-comment">
                36 comments
                </p>
                <a href="" class="btn redirect-ds-reading">
                  Đọc thêm
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-12">
          <div class="new-discussion-container d-flex justify-content-center align-items-center">
            <div class="new-discussion-inner">
              <div class="user-avatar-container w-100 d-flex align-items-center mt-3 ml-3">
                <div class="avatar">
                  <img src="http://bongden.org/sources/images/logo.png">
                  <div class="user-level d-flex justify-content-center align-items-center">
                    <span>35</span>
                  </div>
                </div>
                <div class="name">
                  Bui Quang Dinh
                </div>
              </div>
              <span class="badge badge-secondary ds-type">FAQ</span>
              <div class="w-100 d-flex justify-content-center">
                <div class="w-75">
                  <p href="" class="ds-title">
                    How to make a link look like a button? How to make a link look like a button?
                  </p>
                </div>
              </div>
              <div class="control-container">
                <p class="ds-comment">
                36 comments
                </p>
                <a href="" class="btn redirect-ds-reading">
                  Đọc thêm
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/circle-progress.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/jquery.fittext.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/homepage.js') }}" charset="utf-8"></script>
@endsection
