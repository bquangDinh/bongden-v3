<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAchievement extends Model
{
    protected $table = 'user_achievement';

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function achievement(){
      return $this->belongsTo('App\UserAchievementList','achievement_id');
    }
}
