<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionLike extends Model
{
    protected $table = 'discussion_like';
    
    public function reactor(){
      return $this->belongsTo('App\User','reactor_id');
    }

    public function discussion(){
      return $this->belongsTo('App\Discussion','discussion_id');
    }
}
