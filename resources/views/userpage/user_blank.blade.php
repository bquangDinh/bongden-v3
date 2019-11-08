@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
@endsection

@section('content-title')
Thông báo
@endsection

@section('content')
@if(isset($success))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Welldone !</strong> {{ $success }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if(isset($error))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error !</strong> {{ $error }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@endsection

@section('js')
@endsection
