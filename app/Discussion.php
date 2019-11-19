<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $table = 'discussion';

    public function category(){
      return $this->belongsTo('App\DiscussionCategory','thread_category_id');
    }

    public function author(){
      return $this->belongsTo('App\User','thread_user_id');
    }

    public function comments(){
      return $this->hasMany('App\DiscussionComment');
    }

    public function likes(){
      return $this->hasMany('App\DiscussionLike');
    }

    public function votes(){
      return $this->hasMany('App\DiscussionVote');
    }

    public function upvotes(){
      return $this->hasMany('App\DiscussionVote')->where('vote','up');
    }

    public function downvotes(){
      return $this->hasMany('App\DiscussionVote')->where('vote','down');
    }
}
