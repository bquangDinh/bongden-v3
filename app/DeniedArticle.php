<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeniedArticle extends Model
{
    protected $table = 'denied_article';

    public function article(){
      return $this->belongsTo('App\Article','article_id');
    }

    public function admin(){
      return $this->belongsTo('App\User','admin_id');
    }
}
