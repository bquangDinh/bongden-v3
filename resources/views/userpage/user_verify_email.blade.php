@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
@endsection

@section('content-title')
Xác thực email
@endsection

@section('content')
@if(Auth::check())
@if(!Auth::user()->verified_email)
@if(isset($resend))
@if($resend)
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Thông báo !</strong> Đã gửi lại email
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@endif
<div class="w-100 d-flex justify-content-center align-items-center">
  <img src="{{ URL::asset('sources/images/webpage/userpage/send_email_illustrator.png') }}" class="w-50 h-50">
</div>
<p>Chúng mình đã gửi cho bạn link xác thực qua email bạn đã đăng ký. Trong một số trường hợp, email có thể nằm trong mục spam. Vui lòng kiểm tra hòm thư của bạn</p>
<p>Nếu bạn chưa nhận được email. Bấm vào <a href="{{ route('resend_verified_email') }}">đây</a> để gửi lại.</p>
@else
<p>Bạn đã xác thực email</p>
@endif
@endif
@endsection

@section('js')
@endsection
