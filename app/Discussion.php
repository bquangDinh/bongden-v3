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
}
