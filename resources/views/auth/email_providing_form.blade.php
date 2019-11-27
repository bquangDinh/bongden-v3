@extends('layouts.main')

@section('title')
Bóng Đèn
@endsection

@section('css')
<style media="screen">
  .card-header{
    font-family: Comfortaa-Bold;
  }
  .card-body{
    font-family: Comfortaa-Regular;
  }
</style>
@endsection

@section('content')
<div class="d-none d-lg-block" style="height: 100px;width: 100%">

</div>
@if(isset($invalid_email))
@if($invalid_email)
<div class="w-100 d-flex justify-content-center align-items-center" style="height:50vh">
  <div class="card">
    <div class="card-header">
      Khôi phục mật khẩu
    </div>
    <div class="card-body">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops !</strong> Email 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="" action="{{ route('send_reset_password_link') }}" method="post">
        <div class="form-group">
          <label for="email">Địa chỉ email</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nhập email">
          <small id="emailHelp" class="form-text text-muted">Chúng mình sẽ gửi link khôi phục mật khẩu đến email của bạn.</small>
        </div>
        <div class="form-group d-flex justify-content-center">
          <button type="submit" name="button" class="btn btn-primary">Gửi link khôi phục</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endif
@if(isset($sent))
@if($sent)
<div class="w-100 d-flex justify-content-center align-items-center" style="height:50vh">
  <div class="card">
    <div class="card-header">
      Khôi phục mật khẩu
    </div>
    <div class="card-body">
      <p>Chúng mình đã gửi link khôi phục mật khẩu cho bạn. Trong một vài trường hợp, email có thể nằm trong mục spam. Vui lòng kiểm tra lại hòm thư  của bạn.</p>
      <p>Nếu bạn không tìm thấy email. Bấm vào nút phía dưới để gửi lại.</p>
      <form class="" action="{{ route('resend_reset_password_link') }}" method="post">
        <div class="form-group d-none">
          <label for="email">Địa chỉ email</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nhập email" value="{{ $email }}" required>
          <small id="emailHelp" class="form-text text-muted">Chúng mình sẽ gửi link khôi phục mật khẩu đến email của bạn.</small>
        </div>
        <div class="form-group d-flex justify-content-center">
          <button type="submit" name="button" class="btn btn-primary">Gửi lại link khôi phục</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endif
<div class="w-100 d-flex justify-content-center align-items-center" style="height:50vh">
  <div class="card">
    <div class="card-header">
      Khôi phục mật khẩu
    </div>
    <div class="card-body">
      <form class="" action="{{ route('send_reset_password_link') }}" method="post">
        <div class="form-group">
          <label for="email">Địa chỉ email</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nhập email">
          <small id="emailHelp" class="form-text text-muted">Chúng mình sẽ gửi link khôi phục mật khẩu đến email của bạn.</small>
        </div>
        <div class="form-group d-flex justify-content-center">
          <button type="submit" name="button" class="btn btn-primary">Gửi link khôi phục</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection
