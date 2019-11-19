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

    public function comments(){
      return $this->hasMany('App\ArticleComment');
    }

    public function getReadingTime($wordCount){
      $CONST = 300;
      $time = $wordCount / $CONST;
      $minutes = intval($time);
      $seconds = intval(($time - $minutes) * 60);

      if($minutes == 0){
        return "$seconds giây";
      }

      if($seconds == 0){
        return "$minutes phút";
      }

      return "$minutes phút và $seconds giây";
    }
}
