<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'birthDate', 'gender','password','avatarURL','phoneNumber','award','organization','description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function achieveDetail(){
      return $this->hasOne('App\UserAchievementInfo');
    }

    public function achievements(){
      return $this->hasMany('App\UserAchievement');
    }

    public function followers(){
      return $this->hasMany('App\UserFollower');
    }

    public function articles(){
      return $this->hasMany('App\Article');
    }

    public function discussions(){
      return $this->hasMany('App\Discussion','thread_user_id');
    }

    public function withRoles(){
      return $this->hasMany('App\UserToRole');
    }

    public function notifications(){
      return $this->hasMany('App\UserNotification','notifier_id')->orderBy('created_at','desc');
    }

    public function unreadNotifications(){
      return $this->hasMany('App\UserNotification','notifier_id')->where('read',false)->orderBy('created_at','desc');
    }

    public function activities(){
      return $this->hasMany('App\UserNotification','actor_id')->orderBy('created_at','desc');;
    }

    public function hasPermission($permission_in){
      foreach($this->withRoles as $wRole){
        foreach($wRole->role->permissions as $permission){
          if(strcmp($permission->permission->name,$permission_in) == 0){
            return true;
          }
        }
      }
      return false;
    }

    public function hasRole($role){
      foreach($this->withRoles as $wRole){
        if(strcmp($wRole->role->name,$role) == 0){
          return true;
        }
      }
      return false;
    }
}
