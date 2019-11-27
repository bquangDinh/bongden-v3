<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notification';

    public function actor(){
      return $this->belongsTo('App\User','actor_id');
    }

    public function notifier(){
      return $this->belongsTo('App\User','notifier_id');
    }

    public function type(){
      return $this->belongsTo('App\UserNotificationType','notification_type_id');
    }
}
