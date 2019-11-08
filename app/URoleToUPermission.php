<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URoleToUPermission extends Model
{
    protected $table = 'u_role_to_u_permission';

    public function role(){
      return $this->belongsTo('App\UserRole','role_id');
    }

    public function permission(){
      return $this->belongsTo('App\UserPermission','permission_id');
    }
}
