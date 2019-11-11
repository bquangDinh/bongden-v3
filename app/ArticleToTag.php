<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleToTag extends Model
{
    protected $table = 'article_tag';

    public function article(){
      return $this->belongsTo('App\Article','article_id');
    }

    public function tag(){
      return $this->belongsTo('App\ArticleTag','tag_id');
    }
}
