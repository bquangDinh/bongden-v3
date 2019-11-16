<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionCommentLike extends Model
{
    protected $table = 'discussion_comment_like';

    public function comment(){
      return $this->belongsTo('App\DiscussionComment','comment_id');
    }

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }
}
