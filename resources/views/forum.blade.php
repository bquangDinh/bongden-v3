@extends('layouts.main')

@section('title')
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@endsection

@section('content')
<div class="d-none d-lg-block hidden-panel" style="height: 100px;width: 100%">

</div>
<div class="container-fluid forum-container">
  <div class="row">
    <div class="col-md-3 col-12">
      <div class="discussion-control w-100 d-flex justify-content-center mt-5">
        <a href="{{ route('show_creating_discussion_page') }}" class="btn btn-primary w-75" id="create-new-discussion-btn">Tạo thảo luận</a>
      </div>
    </div>
    <div class="col-md-9 col-12">
      @foreach($discussions as $discussion)
      <div class="discussion-container w-100 mt-5">
        <div class="row">
          <div class="col-md-2 col-12">
            <div class="user-avatar-container w-100 h-100 d-flex align-items-center justify-content-center">
              <div class="avatar" data-exp-percentage="{{ $discussion->author->achieveDetail->exp_percentage_to_next_level($discussion->author->id) }}">
                <img src="{{ $discussion->author->avatarURL }}" alt="author avatar">
                <div class="user-level d-flex justify-content-center align-items-center">
                  <span>
                    {{ $discussion->author->achieveDetail->level }}
                  </span>
                </div>
              </div>
              <div class="name d-md-none d-block">
                {{ $discussion->author->name }}
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="discussion-info-container w-100">
              <h3 class="discussion-title mt-2">
                <a href="{{ route('discussion_reading_page',$discussion->id) }}">
                  {{ $discussion->title }}
                </a>
              </h3>
              <p class="discussion-description mb-2">
                @php
                $html = new \Html2Text\Html2Text($discussion->content);
                @endphp
                {{ substr($html->getText(),0,150).'...' }}
              </p>
            </div>
          </div>
          <div class="col-md-4 col-12">
            <div class="discussion-reaction h-100 d-flex justify-content-center align-items-center">
              <div class="row w-100">
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số bình luận">
                    <i class="far fa-comment" style="color: #ff7675"></i> {{ count($discussion->comments) }}
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số lượt thích">
                    @php
                    $likes_count = 0;
                    foreach($discussion->comments as $comment){
                      $likes_count += count($comment->likes);
                    }
                    @endphp
                    <i class="fas fa-heart" style="color:#FC427B"></i> {{ $likes_count }}
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số phiếu tích cực">
                    <i class="fas fa-chevron-circle-up" style="color: #2ecc71"></i> {{ $discussion->upvote }}
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số phiếu tiêu cực">
                    <i class="fas fa-chevron-circle-down" style="color: #e74c3c"></i> {{ $discussion->downvote }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="discussion-type d-flex justify-content-center align-items-center">
          <a href="#"><i class="fas fa-circle" style="font-size: 10px"></i> {{ $discussion->category->name }}</a>
        </div>
      </div>
      @endforeach
      <div class="discussion-container w-100 mt-5">
        <div class="row">
          <div class="col-md-2 col-12">
            <div class="user-avatar-container w-100 h-100 d-flex align-items-center justify-content-center">
              <div class="avatar" data-exp-percentage="0.75">
                <img src="https://www.pcgamesn.com/wp-content/uploads/2019/04/Astroneer-My-base-900x506.jpg" alt="author avatar">
                <div class="user-level d-flex justify-content-center align-items-center">
                  <span>35</span>
                </div>
              </div>
              <div class="name d-md-none d-block">
                Dinh Bui Quang
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="discussion-info-container w-100">
              <h3 class="discussion-title mt-2">
                <a href="">
                  DSADSDSADSSACXDSDSDSADSDSADSSACXDSDS
                </a>
              </h3>
              <p class="discussion-description mb-2">
                In a grid layout, content must be placed within columns and only columns may be immediate children of rows.
                In a grid layout, content must be placed within columns and only columns may be immediate children of rows.
                In a grid layout, content must be placed within columns and only columns may be immediate children of rows.
              </p>
            </div>
          </div>
          <div class="col-md-4 col-12">
            <div class="discussion-reaction h-100 d-flex justify-content-center align-items-center">
              <div class="row w-100">
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số bình luận">
                    <i class="far fa-comment" style="color: #ff7675"></i> 2
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số lượt thích">
                    <i class="fas fa-heart" style="color:#FC427B"></i> 4
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số phiếu tích cực">
                    <i class="fas fa-chevron-circle-up" style="color: #2ecc71"></i> 5
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số phiếu tiêu cực">
                    <i class="fas fa-chevron-circle-down" style="color: #e74c3c"></i> 6
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="discussion-type d-flex justify-content-center align-items-center">
          <a href="#"><i class="fas fa-circle" style="font-size: 10px"></i> Homework</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/circle-progress.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/jquery.fittext.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/forum.js') }}" charset="utf-8"></script>
@endsection
