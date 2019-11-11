<?php

namespace App\Http\Services;

use App\Discussion;
use App\DiscussionCategory;

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
}
 ?>
