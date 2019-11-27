@extends('layouts.main')

@section('title')
Thảo luận
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/forum.css') }}">
@endsection

@section('content')
<div class="d-none d-lg-block hidden-panel" style="height: 100px;width: 100%">

</div>
<div class="container-fluid forum-container">
  <div class="row">
    <div class="col-12">
      @foreach($discussions as $discussion)
      <div class="discussion-container w-100 mt-5">
        <div class="row">
          <div class="col-md-2 col-12">
            <div class="user-avatar-container w-100 h-100 d-flex align-items-center justify-content-center">
              <div class="avatar" data-us-id="{{ $discussion->author->id }}" data-exp-percentage="{{ $discussion->author->achieveDetail->exp_percentage_to_next_level($discussion->author->id) }}">
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
              <h3 class="discussion-title">
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
                    <i class="fas fa-heart" style="color:#FC427B"></i> {{ count($discussion->likes) }}
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số phiếu tích cực">
                    <i class="fas fa-chevron-circle-up" style="color: #2ecc71"></i> {{ sizeof($discussion->upvotes) }}
                  </div>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  <div class="tippy" data-tippy-message="Số phiếu tiêu cực">
                    <i class="fas fa-chevron-circle-down" style="color: #e74c3c"></i> {{ sizeof($discussion->downvotes) }}
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

      <div class="row d-flex justify-content-center mt-5">
        <div class="col-10 d-flex justify-content-center">
          {{ $discussions->links('vendor.pagination.simple-bootstrap-4') }}
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
