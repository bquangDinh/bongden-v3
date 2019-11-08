<?php
namespace App\Http\Services;

use App\ArticleTag;
use App\ArticleToTag;

class ArticleTagService{

    public static function add_tag_not_esxist($tags){
      //this function will update any tag which not exist in tag table
      $tagIDs = array();

      $tags = array_unique($tags);
      foreach($tags as $tag){
        if(!is_numeric($tag)){
          //tag is invalid
          //means this tag is not exist in tag database
          //add it !
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

    public static function add_article_tag($tag_id,$article_id){
      if(!ArticleToTag::where('article_id',$article_id)->where('tag_id',$tag_id)->first()){
        $article_tag = new ArticleToTag;
        $article_tag->article_id = $article_id;
        $article_tag->tag_id = $tag_id;
        $article_tag->save();
      }
    }
}
