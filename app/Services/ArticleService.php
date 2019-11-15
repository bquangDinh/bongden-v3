<?php
namespace App\Http\Services;

use App\ArticleState;
use App\ArticleSubject;
use App\ArticleTag;
use App\ArticleToTag;
use App\Article;
use App\DeniedArticle;
use App\ArticleComment;
use App\ArticleCommentLike;

use App\Http\Services\UserAchievementService;

class ArticleService{

  /*Article State*/

  //Precondition: $article_id must be found in Article table.
  //Postcondition: The function will find the corresponding record by $article_id
  //check the state. If the state is 'uploaded', return true, otherwise return false.
  //If it cannot find any record, the function will be terminated.
  public static function is_uploaded_article($article_id){
    $article_state = ArticleState::where('article_id',$article_id)->firstOrFail();
    if($article_state->state == 'uploaded') return true;
    return false;
  }

  //Precondition: $article_id must be found in Article table.
  //Postcondition: The function will find the corresponding record by $article_id
  //check the state. If the state is 'upload', return true, otherwise return false.
  //If it cannot find any record, the function will be terminated.
  public static function is_upload_article($article_id){
    $article_state = ArticleState::where('article_id',$article_id)->firstOrFail();
    if($article_state->state == 'upload') return true;
    return false;
  }

  //Precondition: $article_id must be found in Article table.
  //Postcondition: The function will find the corresponding record by $article_id
  //check the state. If the state is 'save', return true, otherwise return false.
  //If it cannot find any record, the function will be terminated.
  public static function is_save_article($article_id){
    $article_state = ArticleState::where('article_id',$article_id)->firstOrFail();
    if($article_state->state == 'save') return true;
    return false;
  }

  //Precondition: $article_id must be found in Article table.
  //$state must be one in three accepted values ('upload','save','uploaded'). Otherwise, the state will be setted by default 'save'
  //Postcondition: The function will find the corresponding article state by article_id.
  //If it cannot find, create a new one and fill the $state in and then return the record.
  //If it found the record => update and return it.
  public static function create_or_update_article_state($article_id,$state){
    if($state != 'upload' && $state != 'uploaded' && $state != 'save' && $state != 'denied'){
      $state = 'save';
    }

    $article_state = ArticleState::where('article_id',$article_id)->first();

    if(!$article_state){
      $new_article_state = new ArticleState;
      $new_article_state->article_id = $article_id;
      $new_article_state->state = $state;
      $new_article_state->save();

      return $new_article_state;
    }

    $article_state->state = $state;
    $article_state->save();

    return $article_state;
  }

  public static function delete_state_of_article($article_id){
    $article_state = ArticleState::where('article_id',$article_id)->first();
    if($article_state) $article_state->delete();
  }
  /*-----------------------*/

  /*Article Tag*/

  //Precondition: $tags is the array which contains all tags that provided by select2 request.
  //Postcondition: The function will check if a tag is exist in database or not.
  //If the tag is string format. It means, the tag is not exist in database. So add a new one
  //After all, the function will return all valid tag by id.
  public static function add_tags_if_not_exist($tags){
    $tagIDs = array();

    $tags = array_unique($tags);

    foreach($tags as $tag){
      if(!is_numeric($tag)){
        $mytag = new ArticleTag;
        $mytag->name = $tag;
        $mytag->save();
        array_push($tagIDs,$mytag->id);
        continue;
      }
      array_push($tagIDs,$tag);
    }

    return $tagIDs;
  }

  //Precondition: $tag_id and $article_id must be found in database.
  //$tag_id is the ID of the tag in Tag table.
  //$article_id is the ID of the article in the Article table.
  //Postcondition: At first, the function will check if the article has that tag or not. If not, add it.
  //and then return the instance.
  public static function add_article_tag($tag_id,$article_id){
    $article_to_tag = ArticleToTag::where('article_id',$article_id)->where('tag_id',$tag_id)->first();
    if(!$article_to_tag){
      $new_article_to_tag = new ArticleToTag;
      $new_article_to_tag->article_id = $article_id;
      $new_article_to_tag->tag_id = $tag_id;
      $new_article_to_tag->save();
      return $new_article_to_tag;
    }
    return $article_to_tag;
  }

  //Precondition: $tagIDs is a list of tags after the article has changed.
  //$article_id is the ID of the article in Article table.
  //Postcondition: New tag will be added, a tag is not longer to be used will be removed.
  public static function update_article_tag($tagIDs,$article_id){
    foreach($tagIDs as $tagid){
      ArticleService::add_article_tag($tagid,$article_id);
    }

    $avaiable_tags = ArticleToTag::where('article_id',$article_id)->get();

    if(count($avaiable_tags) > 0){
      foreach($avaiable_tags as $avaiable_tag){
        if(in_array($avaiable_tag->tag_id,$tagIDs) == false){
          ArticleToTag::destroy($avaiable_tag->id);
        }
      }
    }
  }

  public static function delete_tags_of_article($article_id){
    $article_tags = ArticleToTag::where('article_id',$article_id)->get();
    foreach($article_tags as $article_tag){
      $article_tag->delete();
    }
  }

  public static function get_tags_with_query($query,$select2Format){
    $term = trim($query->q);
    $term = strtolower($term);

    if(empty($term)){
      return response()->json([]);
    }

    $tags = ArticleTag::search($term)->limit(5)->get();

    if($select2Format){
      $formatted_tags = [];

      foreach($tags as $tag){
        $formatted_tags[] = ['id' => $tag->id,'text' => $tag->name];
      }

      return response()->json($formatted_tags);
    }

    return response()->json($tags);
  }
  /*-----------------------*/

  /*Article*/

  public static function create_article_with_request($user_id,$request){
    $article = ArticleService::create_article(
      $request->title,
      $request->cover,
      $request->subject,
      $request->content,
      $user_id,
      $request->submit,
      $request->tag
    );

    if($article == null){
      return -1;
    }

    UserAchievementService::increase_article_by_user_id($user_id,$article->id);

    return 0;
  }

  public static function update_article_with_request($user_id,$request){
    $article = ArticleService::update_article(
      $request->article_id,
      $request->title,
      $request->cover,
      $request->subject,
      $request->content,
      $user_id,
      $request->submit,
      $request->tag
    );

    if($article == null) return -1;

    return 0;
  }

  //Precondition: a valid request that contains all needed infomation to fill out a new article record.
  //Postcondition: If creating article success, the function will the article instance.
  public static function create_article($title,$cover,$subject_id,$content,$user_id,$state,$tags){
    $article = null;

    try{
      $article = new Article;
      $article->title = $title;
      $article->cover_url = $cover;
      $article->subject_id = $subject_id;
      $article->content = $content;
      $rawContent = new \Html2Text\Html2Text($content);
      $article->wordCount = strlen($rawContent->getText());
      $article->user_id = $user_id;
      $article->save();

      ArticleService::create_or_update_article_state($article->id,$state);

      $tagIDs = ArticleService::add_tags_if_not_exist($tags);

      foreach($tagIDs as $tagid){
        ArticleService::add_article_tag($tagid,$article->id);
      }
    }catch(Exception $e){
      return null;
    }

    return $article;
  }

  //Precondition: $user_id,$article_id must be found in corresponding table.
  //$user_id is the ID of the user in User table.
  //$article_id is the ID of the article in Article table.
  //Postcondition:
  public static function update_article($article_id,$title,$cover,$subject_id,$content,$user_id,$state,$tags){
    $article = Article::findOrFail($article_id);
    $article->title = $title;
    $article->cover_url = $cover;
    $article->subject_id = $subject_id;
    $article->content = $content;
    $rawContent = new \Html2Text\Html2Text($content);
    $article->wordCount = strlen($rawContent->getText());
    $article->user_id = $user_id;
    $article->save();

    ArticleService::create_or_update_article_state($article_id,$state);

    $tagIDs = ArticleService::add_tags_if_not_exist($tags);

    foreach($tagIDs as $tagid){
      ArticleService::add_article_tag($tagid,$article->id);
    }

    ArticleService::update_article_tag($tagIDs,$article->id);

    return $article;
  }

  //Precondition: $article_id must be found in Article table
  //$article_id is the ID of the article in Article table
  //Postcondition: The function will delete the article step by step and safely
  //if something gone wrong, -1 will be returned, otherwise 0 will be returned
  public static function delete_article($article_id){
    try{
      ArticleService::delete_state_of_article($article_id);
      ArticleService::delete_tags_of_article($article_id);

      $article = Article::find($article_id);
      if($article) $article->delete();

      UserAchievementService::decrease_article_by_user_id($article->author->id);

    }catch(Exception $e){
      return -1;
    }

    return 0;
  }

  public static function get_all_subjects($select2Format){
    if($select2Format){
      $subjects = ArticleSubject::all();
      $formatted_subjects = [];

      foreach($subjects as $subject){
        $formatted_subjects[] = ['id' => $subject->id,'text' => $subject->name];
      }

      return $formatted_subjects;
    }

    return ArticleSubject::all();
  }

  public static function get_articles_with_user($user_id){
    return Article::where('user_id',$user_id)->orderBy('created_at','asc')->get();
  }

  public static function get_article_ajax($id){
    $article = Article::findOrFail($id);
    $subject_name = $article->subject->name;
    $article->subject = $subject_name;
    return $article;
  }

  public static function get_article($id){
    $article = Article::findOrFail($id);
    return $article;
  }

  public static function get_pending_article(){
    $articles = array();
    $states = ArticleState::where('state','upload')->get();
    foreach($states as $state){
      array_push($articles,$state->article);
    }
    return $articles;
  }

  public static function deny_article($admin_id,$request){
    if(!Article::find($request->article_id)){
      //the article is properly deleted
      return -1;
    }

    if(DeniedArticle::where('article_id',$request->article_id)->first()){
      //the record has already existed
      return -1;
    }

    $denied = new DeniedArticle;
    $denied->article_id = $request->article_id;
    $denied->reason = $request->reason;
    $denied->admin_id = $admin_id;
    $denied->save();

    ArticleService::create_or_update_article_state($request->article_id,"denied");

    return 0;
  }

  public static function get_denied_info($article_id){
    $denied = DeniedArticle::where('article_id',$article_id)->first();
    return $denied;
  }

  public static function approve_article($article_id){
    try{
      $article = Article::find($article_id);
      $state = $article->getState;
      $state->state = "uploaded";
      $state->save();

    }catch(Exception $e){
      return -1;
    }

    return 0;
  }
  /*-----------------------*/


  /*Article Comment*/

  public static function add_comment_with_request($user_id,$request){
    $comment = ArticleService::add_comment($user_id,$request->article_id,$request->comment_content);
    return $comment;
  }

  //Precondition: $user_id,$article_id must be found in database
  //$user_id is the ID of the user who has written the comment
  //$article_id is the ID of the article
  //$comment_content is the content of the comment
  //Postcondition: return a new comment
  public static function add_comment($user_id,$article_id,$comment_content){
    $comment = new ArticleComment;
    $comment->user_id = $user_id;
    $comment->article_id = $article_id;
    $comment->content = $comment_content;
    $comment->save();
    return $comment;
  }

  public static function add_reply_with_request($user_id,$request){
    $reply = ArticleService::add_reply($user_id,$request->article_id,$request->comment_content,$request->parent_id);
    return $reply;
  }

  public static function add_reply($user_id,$article_id,$comment_content,$parent_id){
    $comment = new ArticleComment;
    $comment->user_id = $user_id;
    $comment->article_id = $article_id;
    $comment->content = $comment_content;
    $comment->parent_id = $parent_id;
    $comment->save();
    return $comment;
  }

  public static function like_comment_with_request($user_id,$request){
    $like = ArticleCommentLike::where('comment_id',$request->comment_id)->where('user_id',$user_id)->first();
    if(!$like){
      $new_like = new ArticleCommentLike;
      $new_like->user_id = $user_id;
      $new_like->comment_id = $request->comment_id;
      $new_like->save();
      return $new_like;
    }

    return $like;
  }

  public static function unlike_comment_with_request($user_id,$request){
    $like = ArticleCommentLike::where('comment_id',$request->comment_id)->where('user_id',$user_id)->firstOrFail();
    $like->delete();
    return 0;
  }

  public static function comment_like_count($comment_id){
    return count(ArticleCommentLike::where('comment_id',$comment_id)->get());
  }
}
 ?>
