<?php
namespace App\Http\Services;

use App\Article;
use App\ArticleTag;
use App\ArticleToTag;

use Illuminate\Database\Eloquent\Builder;

class SearchingService{
    public static function search_by_article_name($q){
      $articles = Article::whereHas('getState',function(Builder $query){
        $query->where('state','uploaded');
      })->where('title','like','%'.$q.'%')->orderBy('created_at','desc')->get();
      return $articles;
    }

    public static function search_by_article_tag($term){
      $articles = Article::whereHas('getState',function(Builder $query){
        $query->where('state','uploaded');
      })->whereHas('tags',function(Builder $query) use($term){
        $query->whereHas('tag',function(Builder $q) use ($term){
          $q->where('name','like','%'.$term.'%');
        });
      })->orderBy('created_at','desc')->get();
      return $articles;
    }

    public static function search_by_article_subject($subject){
      $articles = Article::whereHas('getState',function(Builder $query){
        $query->where('state','uploaded');
      })->whereHas('subject',function(Builder $query) use($subject){
        $query->where('name','like','%'.$subject.'%');
      })->orderBy('created_at','desc')->get();
      return $articles;
    }
}

 ?>
