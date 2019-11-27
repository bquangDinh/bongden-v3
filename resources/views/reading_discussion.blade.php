@extends('layouts.main')

@section('title')
{{ $discussion->title }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/reading_article.css') }}">
@endsection

@section('content')
<input type="text" value="{{ $discussion->id }}" style="display: none" id="discussion-id">
<div class="d-none d-lg-block" style="height: 100px;width: 100%">

</div>
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-md-2 col-1">

    </div>
    <div class="col-md-8 col-10">
      <h1 class="article-title">
        {{ $discussion->title }}
      </h1>

      <div class="article-type d-flex justify-content-center mt-4">
        <a href="#">
          {{ $discussion->category->name }}
        </a>
      </div>

      <div class="article-content mt-5">
        {!! $discussion->content !!}
      </div>
    </div>
    <div class="col-md-2 col-1">

    </div>
  </div>
</div>
@if(Auth::check())
<div class="row mt-3 mb-3 d-flex justify-content-center">
  <div class="col-md-4">
    <div class="row">
      <div class="col-3 d-flex justify-content-center">
        <button type="button" class="react-button" id="like-btn" data-liked-d-yet="{{ $discussion->likes->contains('reactor_id',Auth::user()->id) ? 'true' : 'false' }}">
          <i class="fas fa-heart"></i>
        </button>
      </div>
      <div class="col-3 d-flex justify-content-center">
        @php
        $html = new \Html2Text\Html2Text($discussion->content);

        $user_vote = null;

        foreach($discussion->votes as $vote){
          if($vote->reactor_id == Auth::user()->id){
            $user_vote = $vote;
            break;
          }
        }
        @endphp
        <button type="button" id="share-fb-btn" class="react-button" data-href="{{ URL::to('/').'/reading/'.$discussion->id }}" data-title="{{ $discussion->title }}" data-desc="{{ substr($html->getText(),0,150).'...' }}" data-image="{{ URL::asset('sources/images/protected/discussion_shared_background.png') }}">
          <i class="fab fa-facebook"></i>
        </button>
      </div>
      <div class="col-3 d-flex justify-content-center">
        <button type="button" class="react-button" id="upvote-btn" data-voted-d-yet="{{ ($user_vote && $user_vote->vote == 'up') ? 'true' : 'false' }}">
          <i class="fas fa-arrow-circle-up"></i>
        </button>
      </div>
      <div class="col-3 d-flex justify-content-center">
        <button type="button" class="react-button" id="downvote-btn" data-voted-d-yet="{{ ($user_vote && $user_vote->vote == 'down') ? 'true' : 'false' }}">
          <i class="fas fa-arrow-circle-down"></i>
        </button>
      </div>
    </div>
  </div>
</div>
@else
<div class="w-100 d-flex justify-content-center mt-3 mb-3">
  @php
  $html = new \Html2Text\Html2Text($discussion->content);
  @endphp
  <button type="button" id="share-fb-btn" class="react-button" data-href="{{ URL::to('/').'/reading/'.$discussion->id }}" data-title="{{ $discussion->title }}" data-desc="{{ substr($html->getText(),0,150).'...' }}" data-image="{{ URL::asset('sources/images/protected/discussion_shared_background.png') }}">
    <i class="fab fa-facebook"></i>
  </button>
</div>
@endif
<!-- COMMENT SYSTEM -->
<div class="row d-flex justify-content-center">
  <div class="col-md-8 col-sm-11">
    <div class="cm-outer-container" id="cm-outer-container">
      <div class="row d-flex justify-content-center w-100 no-gutters">
        <div class="col-11">
          <div id="comment-count" class="mt-5">
            {{ count($discussion->comments) }} bình luận
          </div>
          <div class="cm-inner-container" id="cm-inner-container">
            @if(Auth::check())
            <!--Answer box-->
            <div id="answer-box" class="cm-container mt-3">
              <div class="user-avatar-container d-flex align-items-center" style="padding-top: 20px;padding-left:20px">
                <div class="avatar" data-us-id="{{ Auth::user()->id }}" data-exp-percentage="{{ Auth::user()->achieveDetail->exp_percentage_to_next_level(Auth::user()->id) }}">
                  <img src="{{ Auth::user()->avatarURL }}" alt="user avatar">
                  <div class="user-level d-flex justify-content-center align-items-center">
                    <span>
                      {{ Auth::user()->achieveDetail->level }}
                    </span>
                  </div>
                </div>
                <div class="name">
                  {{ Auth::user()->name }}
                </div>
              </div>
              <div class="row w-100 no-gutters">
                <div class="col-1"></div>
                <div class="col-md-10 col-9">
                  <textarea id="answerbox-input" placeholder="Bạn muốn nói gì nè ?"></textarea>
                </div>
                <div class="col-md-1 col-2 d-flex justify-content-center align-items-center">
                  <button id="send-answer-btn">
                    <i class="fas fa-paper-plane"></i>
                  </button>
                </div>
              </div>
            </div>

            <!--Reply block-->
            <div id="reply-block" class="mt-3 mb-3 d-none">
              <div class="row">
                <div class="col-1"></div>
                <div class="col-11">
                  <div class="cm-container">
                    <div class="user-avatar-container d-flex align-items-center" style="padding-top: 20px;padding-left:20px">
                      <div class="avatar" data-us-id="{{ Auth::user()->id }}" data-exp-percentage="{{ Auth::user()->achieveDetail->exp_percentage_to_next_level(Auth::user()->id) }}">
                        <img src="{{ Auth::user()->avatarURL }}" alt="user avatar">
                        <div class="user-level d-flex justify-content-center align-items-center">
                          <span>
                            {{ Auth::user()->achieveDetail->level }}
                          </span>
                        </div>
                      </div>
                      <div class="name">
                        {{ Auth::user()->name }} <span style="color: #e3e3e3">đang trả lời</span> <span id="parent_name"></span>
                      </div>
                    </div>
                    <div class="row w-100 no-gutters">
                      <div class="col-1"></div>
                      <div class="col-md-10 col-9">
                        <textarea id="replybox-input" placeholder="Bạn muốn nói gì nè ?"></textarea>
                      </div>
                      <div class="col-md-1 col-2 d-flex justify-content-center align-items-center">
                        <button id="reply-btn" data-parent-id="" data-rl-bl-id="">
                          <i class="fas fa-paper-plane"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="login-warning-container mt-3 mb-3">
              <button type="button" onclick="window.location.href = '/bongden_login?previous=' + window.location.href">Đăng nhập để bình luận</button>
            </div>
            @endif
            <div class="cm-list-container mt-3">
              @foreach($discussion->comments as $comment)
              @if(!$comment->parent_id)
              <div class="cm-outer-pack mt-3" id="cm-bl-{{ $comment->id }}">
                <div class="cm-container">
                  <div class="user-avatar-container d-flex align-items-center" style="padding-top: 20px;padding-left:20px">
                    <div class="avatar" data-us-id="{{ $comment->commentor->id }}" data-exp-percentage="{{ $comment->commentor->achieveDetail->exp_percentage_to_next_level($comment->commentor->id) }}">
                      <img src="{{ $comment->commentor->avatarURL }}" alt="user avatar">
                      <div class="user-level d-flex justify-content-center align-items-center">
                        <span>
                          {{ $comment->commentor->achieveDetail->level }}
                        </span>
                      </div>
                    </div>
                    <div class="name">
                      {{ $comment->commentor->name }}
                    </div>
                  </div>
                  <div class="row w-100 no-gutters">
                    <div class="col-1"></div>
                    <div class="col-md-10 col-9">
                      <p class="cm-content">
                        {{ $comment->content }}
                      </p>
                    </div>
                    <div class="col-1">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-1 col-1"></div>
                    <div class="col-md-8 col-7">
                      @if(Auth::check())
                      @if($comment->likes->contains('user_id',Auth::user()->id))
                      <button type="button" class="unlike-cm-btn" data-comment-id="{{ $comment->id }}" id="lk-cm-{{ $comment_id }}">
                        Đã Thích
                      </button>
                      @else
                      <button type="button" class="like-cm-btn" data-comment-id="{{ $comment->id }}">
                        Thích
                      </button>
                      @endif
                      <button type="button" class="reply-cm-btn" data-rl-bl-id="rl-block-{{ $comment->id }}" data-name="{{ $comment->commentor->name }}" data-parent-id="{{ $comment->id }}">
                        Trả lời
                      </button>
                      @endif
                    </div>
                    <div class="col-md-3 col-4">
                      <span class="like-cm-count">
                        <i class="fas fa-heart" style="color: #e74c3c"></i> <span id="like-cm-count__{{ $comment->id }}">{{ count($comment->likes) }}</span> lượt thích
                      </span>
                    </div>
                  </div>
                </div>
                <!--Reply List-->
                <div class="reply-list mt-3" id="rl-block-{{ $comment->id }}">
                  @if(count($comment->replies) > 0)
                  @foreach($comment->replies as $reply)
                  @include('components.replies',$reply)
                  @endforeach
                  @endif
                </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/circle-progress.min.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ URL::asset('js/vendor/jquery.scrolline.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/reading_discussion.js') }}"></script>
@endsection
