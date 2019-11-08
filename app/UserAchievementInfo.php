<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Services\UserAchievementService;

class UserAchievementInfo extends Model
{
    protected $table = 'user_achievement_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','exp','level','articleCount','followerCount'
    ];

    public function user(){
      return $this->belongsTo('App\User','user_id');
    }

    public function expToLevelUp($currentLevel){
        return UserAchievementService::calculateExpToNextLevel($currentLevel);
    }
}
