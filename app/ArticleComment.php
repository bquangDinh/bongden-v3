<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $table = 'article_comment';

    public function commentor(){
      return $this->belongsTo('App\User','user_id');
    }

    public function replies(){
      return $this->hasMany('App\ArticleComment','parent_id');
    }

    public function parent(){
      return $this->belongsTo('App\ArticleComment','parent_id');
    }

    public function likes(){
      return $this->hasMany('App\ArticleCommentLike','comment_id');
    }

    public function article(){
      return $this->belongsTo('App\Article','article_id');
    }
}
