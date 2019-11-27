@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/userpage/user_notification_page.css') }}">
@endsection

@section('content-title')
Thông báo của bạn
@endsection

@section('content')
<div class="row">
  @foreach(Auth::user()->notifications as $notification)
  <div class="col-12">
    <div class="notification-card mb-4 w-100 {{ $notification->read ? 'noti-read tooltip-o' : '' }}" id="noti-card-{{ $notification->id }}" data-tooltip-message="{{ $notification->read ? 'Bạn đã đọc thông báo này' : '' }}">
      <div class="avatar-container w-100">
        <img src="{{ $notification->actor->avatarURL }}" class="avatar" alt="user avatar">
        <div class="ml-3 name">
          <a href="{{ route('show_user_preview_page',$notification->actor->id) }}">
            {{ $notification->actor->name }}
          </a>
        </div>
        <div class="float-right mr-5 d-none d-lg-block">
          @if(isset($notification->created_at))
          {{ $notification->created_at }}
          @endif
        </div>
      </div>
      <div class="row py-3">
        <div class="col-md-9 col-12 d-flex justify-content-center align-items-center">
          <div class="content w-75">
            {{ $notification->message }}
          </div>
        </div>
        <div class="col-md-3 col-12">
          <div class="row">
            <div class="col-6 d-flex justify-content-center">
              @if($notification->read == false)
              <button type="button" class="mark-as-read-btn tooltip-o" data-tooltip-message="Đánh dấu là đã đọc" data-noti-id="{{ $notification->id }}">
                <i class="fas fa-check"></i>
              </button>
              @endif
            </div>
            <div class="col-6 d-flex justify-content-center">
              <button type="button" class="btn go-to-link-btn tooltip-o" data-tooltip-message="Đi tới bài đích" onclick="window.location.href='{{ $notification->url }}'">
                <i class="fas fa-link"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection

@section('js')
<script src="{{ URL::asset('js/userpage/user_notification_page.js') }}" charset="utf-8"></script>
@endsection
