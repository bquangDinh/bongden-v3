<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UARoleToUAList extends Model
{
    protected $table = 'u_a_role_to_u_a_list';

    public function role(){
      return $this->belongsTo('App\UserAchievementRole','role_id');
    }

    public function achieve(){
      return $this->belongsTo('App\UserAchievementList','achievement_id');
    }
}
