<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionComment extends Model
{
    protected $table = 'discussion_comment';

    public function discussion(){
      return $this->belongsTo('App\Discussion','discussion_id');
    }

    public function commentor(){
      return $this->belongsTo('App\User','user_id');
    }

    public function replies(){
      return $this->hasMany('App\DiscussionComment','parent_id');
    }

    public function parent(){
      return $this->belongsTo('App\DiscussionComment','parent_id');
    }

    public function likes(){
      return $this->hasMany('App\DiscussionCommentLike','comment_id');
    }
}
