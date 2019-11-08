<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAchievementToRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','role_id'
    ];

    protected $table = 'user_achievement_to_role';

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function role(){
      return $this->belongsTo('App\UserAchievementRole','role_id');
    }
}
