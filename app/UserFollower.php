<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFollower extends Model
{
    protected $table = 'user_follower';

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function follower(){
      return $this->belongsTo('App\User','follower_id');
    }
}
