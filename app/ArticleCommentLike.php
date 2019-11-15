<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCommentLike extends Model
{
    protected $table = 'article_comment_like';

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function comment(){
      return $this->belongsTo('App\ArticleComment','comment_id');
    }
}
