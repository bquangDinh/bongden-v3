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
        @if(isset($latest))
        <!-- Lastest Article Section -->
        <div class="row">
          <div class="col-12">
            <div class="lastest-article-container w-100 mt-3">
              <div class="row no-gutters">
                <div class="col-md-7 col-12" style="position: relative">
                  <div class="cover">
                    <img src="{{ $latest->cover_url }}" alt="lastest article cover">
                  </div>
                </div>
                <div class="col-md-5 col-12">
                  <div class="article-info">
                    <a href="{{ route('get_articles_with_subject',$latest->subject->id) }}">
                      <span class="badge badge-success subject">
                        {{ $latest->subject->name }}
                      </span>
                    </a>
                    <span class="badge badge-success reading-time">
                      {{ $latest->getReadingTime($latest->wordCount) }}
                    </span>
                    <div class="info">
                      <p class="title">
                        {{ $latest->title }}
                      </p>
                      <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                        <div class="avatar" data-exp-percentage="{{ $latest->author->achieveDetail->exp_percentage_to_next_level($latest->author->id) }}">
                          <img src="{{ $latest->author->avatarURL }}" alt="author avatar">
                          <div class="user-level d-flex justify-content-center align-items-center">
                            <span>{{ $latest->author->achieveDetail->level }}</span>
                          </div>
                        </div>
                        <div class="name">
                          {{ $latest->author->name }}
                        </div>
                      </div>
                    </div>
                    <div class="read-more-section">
                      <button type="button" onclick="window.location.href = '/reading/{{ $latest->id }}'">
                        Đọc thêm
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="row">
          @if(count($recents) > 1)
          @if(count($recents) == 2)
          @foreach($recents as $recent)
          <div class="col-lg-6 col-sm-12 mt-3">
            <div class="article-container w-100">
              <div class="cover">
                <img src="{{ $recent->cover_url }}">
              </div>
              <div class="article-info">
                <a href="{{ route('get_articles_with_subject',$recent->subject->id) }}">
                  <span class="badge badge-success subject">
                    {{ $recent->subject->name }}
                  </span>
                </a>
                <span class="badge badge-success reading-time">
                  {{ $recent->getReadingTime($recent->wordCount) }}
                </span>
                <div class="info">
                  <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                    <div class="avatar" data-exp-percentage="{{ $recent->author->achieveDetail->exp_percentage_to_next_level($recent->author->id) }}">
                      <img src="{{ $recent->author->avatarURL }}" alt="author avatar">
                      <div class="user-level d-flex justify-content-center align-items-center">
                        <span>
                          {{ $recent->author->achieveDetail->level }}
                        </span>
                      </div>
                    </div>
                    <div class="name">
                      {{ $recent->author->name }}
                    </div>
                  </div>
                  <p class="title">
                    {{ $recent->title }}
                  </p>
                </div>
                <div class="read-more-section">
                  <button onclick="window.location.href = '/reading/{{ $recent->id }}'">Đọc thêm</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          @if(count($recents) == 3)
          @foreach($recents as $recent)
          <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
            <div class="article-container w-100">
              <div class="cover">
                <img src="{{ $recent->cover_url }}">
              </div>
              <div class="article-info">
                <a href="{{ route('get_articles_with_subject',$recent->subject->id) }}">
                  <span class="badge badge-success subject">
                    {{ $recent->subject->name }}
                  </span>
                </a>
                <span class="badge badge-success reading-time">
                  {{ $recent->getReadingTime($recent->wordCount) }}
                </span>
                <div class="info">
                  <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
                    <div class="avatar" data-exp-percentage="{{ $recent->author->achieveDetail->exp_percentage_to_next_level($recent->author->id) }}">
                      <img src="{{ $recent->author->avatarURL }}" alt="author avatar">
                      <div class="user-level d-flex justify-content-center align-items-center">
                        <span>
                          {{ $recent->author->achieveDetail->level }}
                        </span>
                      </div>
                    </div>
                    <div class="name">
                      {{ $recent->author->name }}
                    </div>
                  </div>
                  <p class="title">
                    {{ $recent->title }}
                  </p>
                </div>
                <div class="read-more-section">
                  <button onclick="window.location.href = '/reading/{{ $recent->id }}'">Đọc thêm</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          @endif
          @endif
        </div>

        <div class="mt-5">
          <a href="{{ route('show_articles_page') }}" id="view-all-article">
            Xem toàn bộ <i class="fas fa-arrow-circle-right"></i>
          </a>
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
        <a href="{{ route('show_forum_page') }}" id="redirect-discussion" class="btn mt-3">
          Xem tất cả
        </a>

      </div>
    </div>
    <div class="col-md-9 col-sm-12">
      <div class="row">
        @foreach($discussions as $discussion)
        <div class="col-md-6 col-12">
          <div class="new-discussion-container d-flex justify-content-center align-items-center">
            <div class="new-discussion-inner">
              <div class="user-avatar-container w-100 d-flex align-items-center mt-3 ml-3">
                <div class="avatar" data-exp-percentage="{{ $discussion->author->achieveDetail->exp_percentage_to_next_level($discussion->author->id) }}">
                  <img src="{{ $discussion->author->avatarURL }}">
                  <div class="user-level d-flex justify-content-center align-items-center">
                    <span>{{ $discussion->author->achieveDetail->level }}</span>
                  </div>
                </div>
                <div class="name">
                  {{ $discussion->author->name }}
                </div>
              </div>
              <span class="badge badge-secondary ds-type">
                {{ $discussion->category->name }}
              </span>
              <div class="w-100 d-flex justify-content-center">
                <div class="w-75">
                  <p class="ds-title">
                    {{ $discussion->title }}
                  </p>
                </div>
              </div>
              <div class="control-container">
                <p class="ds-comment">
                {{ count($discussion->comments) }} bình luận
                </p>
                <a href="{{ route('discussion_reading_page',$discussion->id) }}" class="btn redirect-ds-reading">
                  Đọc thêm
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<hr>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/circle-progress.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/jquery.fittext.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/particles.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/homepage.js') }}" charset="utf-8"></script>
@endsection
