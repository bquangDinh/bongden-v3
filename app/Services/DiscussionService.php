<?php

namespace App\Http\Services;

use App\Discussion;
use App\DiscussionCategory;
use App\DiscussionComment;
use App\DiscussionCommentLike;

use App\Http\Services\UserAchievementService;

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
      return $new_like;
    }

    return $like;
  }

  public static function unlike_comment_with_request($user_id,$request){
    $like = DiscussionCommentLike::where('comment_id',$request->comment_id)->where('user_id',$user_id)->firstOrFail();
    $like->delete();
    return 0;
  }

  public static function comment_like_count($comment_id){
    return count(DiscussionCommentLike::where('comment_id',$comment_id)->get());
  }
}
 ?>
