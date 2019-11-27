<div class="row mt-3">
  <div class="col-1"></div>
  <div class="col-11">
    <div class="cm-container" id="rl-bl-{{ $reply->id }}">
      <div class="user-avatar-container d-flex align-items-center" style="padding-top: 20px;padding-left:20px">
        <div class="avatar" data-us-id="{{ $reply->commentor->id }}" data-exp-percentage="{{ $reply->commentor->achieveDetail->exp_percentage_to_next_level($reply->commentor->id) }}">
          <img src="{{ $reply->commentor->avatarURL }}" alt="user avatar">
          <div class="user-level d-flex justify-content-center align-items-center">
            <span>
              {{ $reply->commentor->achieveDetail->level }}
            </span>
          </div>
        </div>
        <div class="name">
          {{ $reply->commentor->name }} <span style="color: #e3e3e3">đã trả lời</span> {{ $reply->parent->commentor->name }}
        </div>
      </div>
      <div class="row w-100 no-gutters">
        <div class="col-1"></div>
        <div class="col-md-10 col-9">
          <p class="cm-content">
            {{ $reply->content }}
          </p>
        </div>
        <div class="col-1">
        </div>
      </div>
      <div class="row">
        <div class="col-md-1 col-1"></div>
        <div class="col-md-8 col-7">
          @if(Auth::check())
          @if($reply->likes->contains('user_id',Auth::user()->id))
          <button type="button" class="unlike-cm-btn" data-comment-id="{{ $reply->id }}" id="lk-rl-{{ $reply->id }}">
            Đã thích
          </button>
          @else
          <button type="button" class="like-cm-btn" data-comment-id="{{ $reply->id }}">
            Thích
          </button>
          @endif
          <button type="button" class="reply-cm-btn" data-rl-bl-id="rl-block-{{ $comment->id }}" data-name="{{ $reply->commentor->name }}" data-parent-id="{{ $reply->id }}">
            Trả lời
          </button>
          @endif
        </div>
        <div class="col-md-3 col-4">
          <span class="like-cm-count">
            <i class="fas fa-heart" style="color: #e74c3c"></i> <span id="like-cm-count__{{ $reply->id }}">{{ count($reply->likes) }}</span> lượt thích
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
@if(count($reply->replies) > 0)
@foreach($reply->replies as $reply)
@include('components.replies',$reply)
@endforeach
@endif
