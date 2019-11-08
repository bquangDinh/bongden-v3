@extends('userpage.user_layout')

@section('title')
Tạo bài viết
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/userpage/user_creating_article.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/vendor/select2.min.css') }}">
@endsection

@section('content-title')
Tạo bài viết
@endsection

@section('content')
<div class="article-header">
  <div class="article-cover-container">
    <div class="article-cover">
      <img id="article-cover-img" src="" alt="Ảnh đại diện cho bài viết">
    </div>
    <button type="button" id="add-btn" href="#upload-cover-modal" rel="modal:open">
      <i class="fas fa-plus"></i>
    </button>
  </div>
</div>

@if($errors->has('cover'))
<div class="text-center mt-2">
  <p class="error-form-control-message">
    {{ $errors->first('cover') }}
  </p>
</div>
@endif

<form action="{{ route('create_article') }}" method="post">
  @csrf
  <input type="text" name="cover" id="cover-input" style="display: none">
  <div class="form-group">
    <div class="row">
      <div class="col-12 d-flex justify-content-center align-items-center flex-column">
        <div class="article-title mt-5">
          <input type="text" name="title" placeholder="New Document Name" class="form-text" required>
        </div>
        @if($errors->has('title'))
        <p class="error-form-control-message">
          {{ $errors->first('title') }}
        </p>
        @endif
      </div>
    </div>
  </div>

  <!-- Page Heading -->
  <h1 class="h5 mb-4 text-gray-800">Thể loại</h1>

  <div class="form-group">
    <select id="subject_select" name="subject">
    </select>
  </div>

  <hr />

  <!-- Page Heading -->
  <h1 class="h5 mb-4 text-gray-800">Nội dung</h1>

  @if($errors->has('content'))
  <p class="error-form-control-message">
    {{ $errors->first('content') }}
  </p>
  @endif

  <div class="form-group">
    <textarea name="content" id="textarea-content"></textarea>
  </div>

  <!-- Page Heading -->
  <h1 class="h5 mb-4 text-gray-800">Thêm thẻ tag</h1>

  <div class="form-group">
    <select id="tag_select" name="tag[]" multiple="multiple">
    </select>
  </div>

  <div class="row d-flex justify-content-center">
    <div class="col-md-4 col-sm-10 d-flex justify-content-around">
      <button type="submit" name="submit" value="upload" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">Đăng</span>
      </button>
      <button type="submit" name="submit" value="save" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-save"></i>
        </span>
        <span class="text">Lưu bản nháp</span>
      </button>
    </div>
  </div>
</form>

<div class="modal" id="upload-cover-modal">
  <a href="#" rel="modal:close">Close</a>
</div>
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/j3z8kdc0di1465wji07upkwwuc7exvti07rixz2ewht51abv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript" src="{{ URL::asset('js/vendor/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/userpage/user_creating_article.js') }}"></script>
@endsection
