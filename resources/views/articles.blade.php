@extends('layouts.main')

@section('title')
Bóng Đèn
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/articles_page.css') }}">
@endsection

@section('content')
<div class="d-none d-lg-block" style="height: 100px;width: 100%">

</div>
<div class="article-section container-fluid">
  <div class="row">
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
            <button onclick="window.location.href = '/reading/{{ $article->id }}'">Đọc thêm</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="row d-flex justify-content-center mt-5">
    <div class="col-10 d-flex justify-content-center">
      {{ $articles->links('vendor.pagination.simple-bootstrap-4') }}
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/circle-progress.min.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/vendor/jquery.fittext.js') }}" charset="utf-8"></script>
<script src="{{ URL::asset('js/articles_page.js') }}" charset="utf-8"></script>
@endsection
