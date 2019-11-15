@extends('layouts.main')

@section('title')
Bóng Đèn
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/searching_found_page.css') }}">
@endsection

@section('content')
<div class="d-none d-lg-block" style="height: 100px;width: 100%">

</div>
<div class="article-section container-fluid">
  @if(count($articles) == 0 && count($articles_with_tag) == 0 && count($articles_with_subject) == 0)
  <div id="app">
    <div id="wrapper">
        <h1 class="glitch" data-text="#@!$!@#! :((">#@!$!@#! :((</h1>
        <span class="sub">Không tìm thấy kết quả trùng khớp</span>
    </div>
  </div>
  @else
  @if(count($articles) > 0)
  <div class="w-100 text-center" style="padding-top: 20px">
    <h3 class="display-4">{{ $query }}</h3>
    <h3>
      <span class="badge badge-primary">Theo tên bài viết</span>
    </h3>
    <h4>
      <span class="badge badge-primary">{{ count($articles) }} kết quả</span>
    </h4>
  </div>
  <div class="row mt-3">
    @foreach($articles as $article)
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
      <div class="article-container w-100">
        <div class="cover">
          <img src="{{ $article->cover_url }}">
        </div>
        <div class="article-info">
          <span class="badge badge-success subject">
            {{ $article->subject->name }}
          </span>
          <span class="badge badge-success reading-time">
            {{ $article->getReadingTime($article->wordCount) }}
          </span>
          <div class="info">
            <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
              <div class="avatar" data-exp-percentage="{{ $article->author->achieveDetail->exp_percentage_to_next_level($article->author->id) }}">
                <img src="{{ $article->author->avatarURL }}" alt="author avatar">
                <div class="user-level d-flex justify-content-center align-items-center">
                  <span>
                    {{ $article->author->achieveDetail->level }}
                  </span>
                </div>
              </div>
              <div class="name">
                {{ $article->author->name }}
              </div>
            </div>
            <p class="title">
              {{ $article->title }}
            </p>
          </div>
          <div class="read-more-section">
            <button onclick="window.location.href = '{{ route('reading_page',$article->id) }}'">Đọc thêm</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
  @if(count($articles_with_tag) > 0)
  <div class="w-100 text-center" style="padding-top:20px">
    <h3 class="display-4">{{ $query }}</h3>
    <h3>
      <span class="badge badge-primary">Theo tag</span>
    </h3>
    <h4>
      <span class="badge badge-primary">{{ count($articles_with_tag) }} kết quả</span>
    </h4>
  </div>

  <div class="row mt-3">
    @foreach($articles_with_tag as $article)
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
      <div class="article-container w-100">
        <div class="cover">
          <img src="{{ $article->cover_url }}">
        </div>
        <div class="article-info">
          <span class="badge badge-success subject">
            {{ $article->subject->name }}
          </span>
          <span class="badge badge-success reading-time">
            {{ $article->getReadingTime($article->wordCount) }}
          </span>
          <div class="info">
            <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
              <div class="avatar" data-exp-percentage="{{ $article->author->achieveDetail->exp_percentage_to_next_level($article->author->id) }}">
                <img src="{{ $article->author->avatarURL }}" alt="author avatar">
                <div class="user-level d-flex justify-content-center align-items-center">
                  <span>
                    {{ $article->author->achieveDetail->level }}
                  </span>
                </div>
              </div>
              <div class="name">
                {{ $article->author->name }}
              </div>
            </div>
            <p class="title">
              {{ $article->title }}
            </p>
          </div>
          <div class="read-more-section">
            <button onclick="window.location.href = '{{ route('reading_page',$article->id) }}'">Đọc thêm</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
  @if(count($articles_with_subject) > 0)
  <div class="w-100 text-center" style="padding-top:20px">
    <h3 class="display-4">{{ $query }}</h3>
    <h3>
      <span class="badge badge-primary">Theo loại</span>
    </h3>
    <h4>
      <span class="badge badge-primary">{{ count($articles_with_subject) }} kết quả</span>
    </h4>
  </div>

  <div class="row mt-3">
    @foreach($articles_with_subject as $article)
    <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
      <div class="article-container w-100">
        <div class="cover">
          <img src="{{ $article->cover_url }}">
        </div>
        <div class="article-info">
          <span class="badge badge-success subject">
            {{ $article->subject->name }}
          </span>
          <span class="badge badge-success reading-time">
            {{ $article->getReadingTime($article->wordCount) }}
          </span>
          <div class="info">
            <div class="user-avatar-container mt-2 w-100 d-flex align-items-center">
              <div class="avatar" data-exp-percentage="{{ $article->author->achieveDetail->exp_percentage_to_next_level($article->author->id) }}">
                <img src="{{ $article->author->avatarURL }}" alt="author avatar">
                <div class="user-level d-flex justify-content-center align-items-center">
                  <span>
                    {{ $article->author->achieveDetail->level }}
                  </span>
                </div>
              </div>
              <div class="name">
                {{ $article->author->name }}
              </div>
            </div>
            <p class="title">
              {{ $article->title }}
            </p>
          </div>
          <div class="read-more-section">
            <button onclick="window.location.href = '{{ route('reading_page',$article->id) }}'">Đọc thêm</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
  @endif
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/circle-progress.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/jquery.fittext.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/slick.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/articles_page.js') }}" charset="utf-8"></script>
@endsection
