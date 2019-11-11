@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/vendor/select2.min.css') }}">
<style>
  .error-form-control-message{
    color: #e74c3c;
  }
</style>
@endsection

@section('content-title')
Tạo thảo luận
@endsection

@section('content')
<form action="{{ route('creating_discussion') }}" method="post">
@csrf
<div class="form-group">
    <label for="title-field">Tiêu đề</label>
    @if($errors->has('title'))
    <p class="error-form-control-message">
      {{ $errors->first('title') }}
    </p>
    @endif
    <input type="text" class="form-control" id="title-field" name="title" placeholder="Tiêu đề">
</div>
<div class="form-group">
    <label for="discussion-category">Thể loại</label>
    <select name="thread_category_id" id="discussion-category" class="form-control">
    </select>
</div>
<div class="form-group">
    @if($errors->has('content'))
    <p class="error-form-control-message">
      {{ $errors->first('content') }}
    </p>
    @endif
    <label for="content-field">Nội dung</label>
    <textarea type="text" class="form-control" id="content-field" name="content" placeholder="Bạn muốn nói gì nè ?"></textarea>
</div>
<div class="w-100 d-flex justify-content-center">
  <button type="submit" name="submit" value="upload" class="btn btn-success btn-icon-split">
    <span class="icon text-white-50">
      <i class="fas fa-plus"></i>
    </span>
    <span class="text">Đăng thảo luận</span>
  </button>
</div>
</form>
@endsection

@section('js')
<script src="https://cdn.tiny.cloud/1/j3z8kdc0di1465wji07upkwwuc7exvti07rixz2ewht51abv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript" src="{{ URL::asset('js/vendor/select2.min.js') }}"></script>
<script src="{{ URL::asset('js/userpage/user_creating_discussion.js') }}" charset="utf-8"></script>
@endsection
