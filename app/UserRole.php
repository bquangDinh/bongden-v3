<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    public function permissions(){
      return $this->hasMany('App\URoleToUPermission','role_id');
    }
}
