<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    public function subject(){
      return $this->belongsTo('App\ArticleSubject','subject_id');
    }

    public function author(){
      return $this->belongsTo('App\User','user_id');
    }

    public function getState(){
      return $this->hasOne('App\ArticleState');
    }

    public function tags(){
      return $this->hasMany('App\ArticleToTag');
    }
}
