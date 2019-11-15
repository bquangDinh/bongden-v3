@extends('layouts.main')

@section('title')
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@endsection

@section('content')
<div class="d-none d-lg-block hidden-panel" style="height: 100px;width: 100%">

</div>
<div class="forum-container w-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-sm-12">
          <div class="discussion-center-container d-flex justify-content-center flex-column w-100 mt-5 ml-3">
            <a href="{{ route('show_creating_discussion_page') }}" id="start-new-discussion-btn" class="shadow">
              Tạo bài thảo luận
            </a>
            <div class="discussion-filter-field mt-5">
              <i class="far fa-comment"></i> Hiện tất cả
            </div>
          </div>
          <hr>
          <div class="d-flex justify-content-center flex-column w-100 mt-3 ml-3">
            <div class="discussion-filter-field">
              <i class="fas fa-circle"></i> FAQ
            </div>
            <div class="discussion-filter-field mt-3">
              <i class="fas fa-circle"></i> Feedback
            </div>
          </div>
      </div>
      <div class="col-md-9 col-sm-10">
        <div class="n-container px-3">
          <select class="browser-default custom-select mt-5" id="lastest-btn">
            <option value="0" selected>Lastest first</option>
            <option value="1">Lastest first</option>
            <option value="2">Lastest first</option>
            <option value="3">Lastest first</option>
          </select>
          <div class="discussion-container mt-4">
            <div class="discussion w-100 mr-4 mb-3">
              <div class="category">
                <a href="">
                  <i class="fas fa-circle"></i> sadsadsads
                </a>
              </div>
              <div class="row">
                <div class="col-md-2 col-3">
                    <div class="author-avatar-container w-100 h-100 d-flex justify-content-center">
                        <img class="mt-3 ml-2" src="">
                    </div>
                </div>
                <div class="col-md-7 col-9">
                  <div class="discussion-info-container w-100">
                    <div class="title mt-3">
                        <a href="">
                          sadsadsadsasadsdasd
                        </a>
                    </div>
                    <div class="description mt-3">
                      sadsadsadsasdsadsa
                  </div>
                </div>
                </div>
                <div class="col-md-3 col-12">
                  <div class="commenter-avatar-list w-100">
                    <div class="avatar avatar-showing-more-btn d-flex justify-content-center align-items-center">
                      <i class="fas fa-ellipsis-h"></i>
                    </div>
                    <div class="count-comment">
                      <i class="far fa-comment"></i> 5 comments
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection
