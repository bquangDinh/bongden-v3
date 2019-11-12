@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
@endsection

@section('content-title')
Đổi mật khẩu
@endsection

@section('content')
@if(isset($error))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error !</strong> {{ $error }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      Đổi mật khẩu
    </h6>
  </div>
  <div class="card-body">
    <div class="w-100 d-flex justify-content-center">
      <form action="{{ route('change_password') }}" method="post" class="w-75">
        {{ csrf_field() }}
        <div class="form-group row">
          <label for="current-password" class="col-sm-3 col-form-label">Mật khẩu hiện tại</label>
          <div class="col-sm-9">
            <input type="password" name="current_password" id="current-password" class="form-control" required>
          </div>
        </div>

        @if($errors->has('new_password'))
        <div class="text-center mt-2">
          <p class="error-form-control-message">
            {{ $errors->first('new_password') }}
          </p>
        </div>
        @endif

        <div class="form-group row">
          <label for="new-password" class="col-sm-3 col-form-label">Mật khẩu mới</label>
          <div class="col-sm-9">
            <input type="password" name="new_password" id="new-password" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="confirm-password" class="col-sm-3 col-form-label">Xác nhận</label>
          <div class="col-sm-9">
            <input type="password" name="new_password_confirmation" id="confirm-password" class="form-control" required>
          </div>
        </div>
        <div class="w-100 d-flex justify-content-center form-group">
          <button type="submit" class="btn btn-outline-success">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection
