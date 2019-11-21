<div class="cm-outer-pack">
  <div class="cm-container mt-3">
    <div class="user-avatar-container d-flex align-items-center" style="padding-top: 20px;padding-left:20px">
      <div class="avatar" data-us-id="{{ $comment->commentor->id }}" data-exp-percentage="{{ $comment->commentor->achieveDetail->exp_percentage_to_next_level($comment->commentor->id) }}">
        <img src="{{ $comment->commentor->avatarURL }}" alt="user avatar">
        <div class="user-level d-flex justify-content-center align-items-center">
          <span>
            {{ $comment->commentor->achieveDetail->level }}
          </span>
        </div>
      </div>
      <div class="name">
        {{ $comment->commentor->name }}
      </div>
    </div>
    <div class="row w-100 no-gutters">
      <div class="col-1"></div>
      <div class="col-md-10 col-9">
        <p class="cm-content">
          {{ $comment->content }}
        </p>
      </div>
      <div class="col-1">
      </div>
    </div>
    <div class="row">
      <div class="col-md-1 col-1"></div>
      <div class="col-md-8 col-7">
        @if(Auth::check())
        @if($comment->likes->contains('user_id',Auth::user()->id))
        <button type="button" class="unlike-cm-btn" data-comment-id="{{ $comment->id }}">
          Đã thích
        </button>
        @else
        <button type="button" class="like-cm-btn" data-comment-id="{{ $comment->id }}">
          Thích
        </button>
        @endif
        <button type="button" class="reply-cm-btn" data-rl-bl-id="rl-block-{{ $comment->id }}" data-name="{{ $comment->commentor->name }}" data-parent-id="{{ $comment->id }}">
          Trả lời
        </button>
        @endif
      </div>
      <div class="col-md-3 col-4">
        <span class="like-cm-count">
          <i class="fas fa-heart" style="color: #e74c3c"></i> <span id="like-cm-count__{{ $comment->id }}">{{ count($comment->likes) }}</span> lượt thích
        </span>
      </div>
    </div>
  </div>
  <!--Reply List-->
  <div class="reply-list mt-3" id="rl-block-{{ $comment->id }}">

  </div>
</div>
