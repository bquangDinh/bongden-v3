<?php
namespace App\Http\Services;

use App\ArticleState;
use App\ArticleSubject;
use App\ArticleTag;
use App\ArticleToTag;
use App\Article;

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
    if($state != 'upload' && $state != 'uploaded' && $state != 'save'){
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

  public static function update_article_tag($tagIDs,$article_id){
  
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
      $request->tag);

    if($article == null){
      return -1;
    }

    UserAchievementService::increase_article_by_user_id($user_id,$article->id);

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
  public static function update_article($user_id,$article_id,$title,$cover,$subject_id,$content,$user_id,$state,$tags){
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
  }

  public static function delete_article(){

  }


  /*-----------------------*/

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

  public static function getSubjectIDRange(){
    $range = array();
    $first = ArticleSubject::firstOrFail();
    array_push($range,$first->id);

    $lastest = ArticleSubject::latest()->first();
    array_push($range,$lastest->id);

    return $range;
  }

  public static function create($user_id,$request){
    try{
      $article = new Article;
      $article->title = $request->title;
      $article->cover_url = $request->cover;
      $article->subject_id = $request->subject;
      $article->content = $request->content;
      $rawContent = new \Html2Text\Html2Text($request->content);
      $article->wordCount = strlen($rawContent->getText());
      $article->user_id = $user_id;
      $article->save();

      $article_state = new ArticleState;
      $article_state->article_id = $article->id;
      $article_state->state = $request->submit;
      $article_state->save();

      $tagIDs = ArticleTagService::add_tag_not_esxist($request->tag);

      foreach($tagIDs as $tagid){
        ArticleTagService::add_article_tag($tagid,$article->id);
      }
    }catch(Exception $e){
      return -1;
    }
    return 0;
  }

  public static function delete($article_id){
    try{
      $article_state = ArticleState::where('article_id',$article_id)->firstOrFail();
      if($article_state) $article_state->delete();

      $article_tags = ArticleToTag::where('article_id',$article_id)->get();
      foreach($article_tags as $article_tag){
        $article_tag->delete();
      }

      $article = Article::findOrFail($article_id);
      if($article) $article->delete();
    }catch(Exception $e){
      return -1;
    }

    return 0;
  }

  public static function get_articles_with_user($user_id){
    return Article::where('user_id',$user_id)->orderBy('created_at','asc')->get();
  }

  public static function get_article($id){
    $article = Article::findOrFail($id);
    $subject_name = $article->subject->name;
    $article->subject = $subject_name;
    return $article;
  }
}
 ?>
