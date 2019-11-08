<?php
namespace App\Http\Services;

use App\ArticleState;
use App\ArticleSubject;
use App\ArticleTag;
use App\ArticleToTag;
use App\Article;

use App\Http\Services\ArticleTagService;

class ArticleService{
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

  public static function add_tag_if_not_exist(){

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
