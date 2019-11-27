<?php

namespace App\Http\Services;

use App\Discussion;
use App\DiscussionCategory;
use App\DiscussionComment;
use App\DiscussionCommentLike;
use App\DiscussionLike;
use App\DiscussionVote;

use App\Http\Services\UserAchievementService;
use App\Http\Services\NotificationService;
use App\Http\Services\UserService;

class DiscussionService{

  public static function create_discussion_with_request($user_id,$request){
    try{
      $discussion = DiscussionService::create_discussion(
        $request->title,
        $request->content,
        $user_id,
        $request->thread_category_id
      );

      UserAchievementService::increase_discussion_by_user_id($user_id);

    }catch(Exception $e){
      return -1;
    }

    return 0;
  }

  public static function create_discussion($title,$content,$user_id,$thread_category_id){
    $discussion = new Discussion;
    $discussion->title = $title;
    $discussion->content = $content;
    $rawContent = $content = new \Html2Text\Html2Text($content);
    $discussion->thread_user_id = $user_id;
    $discussion->thread_category_id = $thread_category_id;
    $discussion->wordCount = strlen($rawContent->getText());
    $discussion->save();
    return $discussion;
  }

  public static function get_discussion_by_id($discussion_id){
    return Discussion::find($discussion_id);
  }

  public static function get_discussion_categories($select2Format){
    if($select2Format){
      $categories = DiscussionCategory::all();
      $formatted_subjects = [];

      foreach($categories as $category){
        $formatted_subjects[] = ['id' => $category->id,'text' => $category->name];
      }

      return $formatted_subjects;
    }

    return DiscussionCategory::all();
  }

  public static function get_all_discussion(){
    return Discussion::orderBy('created_at','desc')->simplePaginate(6);
  }

  public static function get_discussion($discussion_id){
    return Discussion::find($discussion_id);
  }

  /*Discussion Comment*/

  public static function add_comment_with_request($user_id,$request){
    $comment = DiscussionService::add_comment($user_id,$request->discussion_id,$request->comment_content);

    if($user_id != $comment->discussion->author->id){
      NotificationService::send_notification_discussion_commented($comment->commentor,$comment->discussion,$comment);
    }

    return $comment;
  }

  //Precondition: $user_id,$article_id must be found in database
  //$user_id is the ID of the user who has written the comment
  //$article_id is the ID of the article
  //$comment_content is the content of the comment
  //Postcondition: return a new comment
  public static function add_comment($user_id,$discussion_id,$comment_content){
    $comment = new DiscussionComment;
    $comment->user_id = $user_id;
    $comment->discussion_id = $discussion_id;
    $comment->content = $comment_content;
    $comment->save();
    return $comment;
  }

  public static function add_reply_with_request($user_id,$request){
    $reply = DiscussionService::add_reply($user_id,$request->discussion_id,$request->comment_content,$request->parent_id);

    if($user_id != $reply->parent->user_id && $user_id != \Auth::user()->id){
      if($reply->parent->parent == null){
        //reply a comment
        NotificationService::send_notification_comment_replied_discussion($reply->commentor,$reply->discussion,$reply);
      }else{
        //reply a reply
        NotificationService::send_notification_reply_replied_discussion($reply->commentor,$reply->discussion,$reply);
      }
    }

    return $reply;
  }

  public static function add_reply($user_id,$discussion_id,$comment_content,$parent_id){
    $comment = new DiscussionComment;
    $comment->user_id = $user_id;
    $comment->discussion_id = $discussion_id;
    $comment->content = $comment_content;
    $comment->parent_id = $parent_id;
    $comment->save();
    return $comment;
  }

  public static function like_comment_with_request($user_id,$request){
    $like = DiscussionCommentLike::where('comment_id',$request->comment_id)->where('user_id',$user_id)->first();
    if(!$like){
      $new_like = new DiscussionCommentLike;
      $new_like->user_id = $user_id;
      $new_like->comment_id = $request->comment_id;
      $new_like->save();

      //send noti
      if($user_id != $new_like->comment->user_id){
        NotificationService::send_notification_comment_liked_discussion($new_like->user,$new_like->comment->discussion,$new_like->comment);
      }

      return $new_like;
    }

    return $like;
  }

  public static function unlike_comment_with_request($user_id,$request){
    $like = DiscussionCommentLike::where('comment_id',$request->comment_id)->where('user_id',$user_id)->first();
    if($like){
      $like->delete();
    }
    return 0;
  }

  public static function comment_like_count($comment_id){
    return count(DiscussionCommentLike::where('comment_id',$comment_id)->get());
  }

  public static function like_discussion_with_request($user_id,$request){
    return DiscussionService::like_discussion($user_id,$request->discussion_id);
  }

  public static function like_discussion($user_id,$discussion_id){
    $like = DiscussionLike::where('reactor_id',$user_id)->where('discussion_id',$discussion_id)->first();
    if(!$like){
      $new_like = new DiscussionLike;
      $new_like->discussion_id = $discussion_id;
      $new_like->reactor_id = $user_id;
      $new_like->save();

      $discussion = DiscussionService::get_discussion_by_id($discussion_id);

      if($user_id != $discussion->author->id){
        //user_id is the actor
        //author is the notifier
        //actor and notifier cannot be the same
        NotificationService::send_notification_discussion_liked(UserService::get_user_by_id($user_id),$discussion);
      }

      return $new_like;
    }

    return $like;
  }

  public static function unlike_discussion_with_request($user_id,$request){
    $like = DiscussionLike::where('reactor_id',$user_id)->where('discussion_id',$request->discussion_id)->first();
    if($like){
      $like->delete();
    }
    return 0;
  }

  public static function count_like_discussion($discussion_id){
    return count(DiscussionLike::where('discussion_id',$discussion_id)->get());
  }

  public static function upvote_discussion_with_request($user_id,$request){
    $vote = DiscussionVote::where('discussion_id',$request->discussion_id)->where('reactor_id',$user_id)->first();
    if($vote){
      $vote->vote = "up";
      $vote->save();
    }else{
      $new_vote = new DiscussionVote;
      $new_vote->discussion_id = $request->discussion_id;
      $new_vote->reactor_id = $user_id;
      $new_vote->vote = "up";
      $new_vote->save();
    }

    $discussion = DiscussionService::get_discussion_by_id($request->discussion_id);

    if($user_id != $discussion->author->id){
      NotificationService::send_notification_discussion_upvoted(UserService::get_user_by_id($user_id),$discussion);
    }

    return 0;
  }

  public static function downvote_discussion_with_request($user_id,$request){
    $vote = DiscussionVote::where('discussion_id',$request->discussion_id)->where('reactor_id',$user_id)->first();
    if($vote){
      $vote->vote = "down";
      $vote->save();
    }else{
      $new_vote = new DiscussionVote;
      $new_vote->discussion_id = $request->discussion_id;
      $new_vote->reactor_id = $user_id;
      $new_vote->vote = "down";
      $new_vote->save();
    }

    $discussion = DiscussionService::get_discussion_by_id($request->discussion_id);

    if($user_id != $discussion->author->id){
      NotificationService::send_notification_discussion_downvoted(UserService::get_user_by_id($user_id),$discussion);
    }

    return 0;
  }
}
 ?>
