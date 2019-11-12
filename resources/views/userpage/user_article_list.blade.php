@extends('userpage.user_layout')

@section('title')
{{ Auth::user()->name }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/vendor/datatables.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/userpage/user_article_list.css') }}">
@endsection

@section('content-title')
Danh sách bài viết
@endsection

@section('content')
<table class="table w-100" id="article_table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tên bài viết</th>
            <th scope="col"></th>
            <th scope="col">Thể loại</th>
            <th scope="col">Trạng thái</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($articles as $key=>$article)
        <tr>
            <th scope="row">{{ $key }}</th>
            <th>
                <a href="#animatedModal" class="open-article-preview" data-article-id=" {{ $article->id }} ">
                    {{ $article->title }}
                </a>
            </th>
            <th>
                <img src="{{ $article->cover_url }}" class="article-preview-cover">
            </th>
            <th>{{ $article->subject->name }}</th>
            @if($article->getState->state == "upload")
            <th style="color: #fdcb6e">Đợi phê duyệt</th>
            @elseif($article->getState->state == "save")
            <th>Bản nháp</th>
            @elseif($article->getState->state == "denied")
            <th style="color: #e74c3c">
                <button type="button" class="btn btn-danger admin-deleted-btn" data-article-id="{{ $article->id }}">
                    Bị từ chối <i class="fas fa-exclamation-circle"></i>
                </button>
            </th>
            @else
            <th style="color: #2ecc71">Đã đăng</th>
            @endif

            @if($article->getState->state != "uploaded")
            <th>
                <button type="button" class="btn btn-outline-danger delete-article-btn" data-article-id="{{ $article->id }}">Xóa</button>
            </th>
            @else
            <th>
                <button type="button" class="btn btn-secondary delete-article-btn" data-article-id="{{ $article->id }}" disabled>Xóa</button>
            </th>
            @endif

            <th>
                <a class="btn btn-outline-success update-article-btn" href="{{ route('show_editing_article_page',[$article->id]) }}">Sửa</a>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>

@if(sizeof($articles) > 0)
<div id="animatedModal">
    <!--THIS IS IMPORTANT! to close the modal, the class name has to match the name given on the ID  class="close-animatedModal" -->
    <button class="close-animatedModal">
        <i class="fas fa-times"></i>
    </button>

    <div class="modal-content">
        <div class="lds-grid" id="loading">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div>
            <div class="article-cover-container" style="display: none">
                <div class="article-cover">
                    <img id="article-cover__image" src="http://batterupbeauty.com/wp-content/uploads/illustration-wallpaper-hd-art-4k-wallpapers-for-desktop-and-mobile-art-wallpaper.jpg">
                </div>
                <div class="article-lowerside d-none d-lg-block">

                </div>
            </div>
        </div>

        <div class="container-fluid article-main-content" style="display: none">
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-8">
                    <div id="article-title">

                    </div>
                    <div class="article-type d-flex justify-content-center mt-4">
                        <a href="#" id="article-type-link"></a>
                    </div>
                    <div id="article-content" class="mt-5">

                    </div>
                </div>
                <div class="col-2">

                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('js')
<script src="{{ URL::asset('js/vendor/datatables.min.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ URL::asset('js/vendor/animatedModal.min.js') }}"></script>
<script type="text/javascript">
    $("#article_table").DataTable();
</script>
<script src="{{ URL::asset('js/userpage/user_article_list.js') }}" charset="utf-8"></script>
@endsection
