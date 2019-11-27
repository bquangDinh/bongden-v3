<?php
namespace App\Http\Services;

use App\Http\Services\UserAchievementService;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\UserPermission;
use App\UserRole;
use App\UserToRole;
use App\URoleToUPermission;

use Mail;
use App\Mail\VerifyEmail;
use App\Mail\ResetPasswordEmail;

class UserService{
  /*User Roles and Permission*/
  const PERMISSION_NORMAL = 'normal';
  const PERMISSION_CONTENT_EXECUTIVE = 'content_executive';
  const PERMISSION_USER_MANAGER = 'user_manager';

  const USER_DEFAULT_AVATAR = '/sources/images/protected/logo.png';

  public static function set_permission_for_normal($user_id){
    $userToRole = UserToRole::where('user_id',$user_id)->first();
    $role = UserRole::where('name','=',self::PERMISSION_NORMAL)->firstOrFail(); // normal guys

    if(!$userToRole){
      $new_userToRole = new UserToRole;
      $new_userToRole->user_id = $user_id;
      $new_userToRole->role_id = $role->id;
      $new_userToRole->save();
      return $new_userToRole;
    }

    $userToRole->role_id = $role->id;
    $userToRole->save();
    return $userToRole;
  }

  public static function verify_email_of_user($user_id,$verified_email_token){
    $user = User::findOrFail($user_id);
    if($user->verified_email_token == $verified_email_token){
      $user->verified_email = true;
      $user->verified_email_at = Carbon::now();
      $user->save();
      return 0;
    }
    return -1;
  }

  public static function send_verify_email_with_user($user){
    Mail::to($user->email)->send(new VerifyEmail($user));
  }

  public static function send_reset_password_link($email){
    $user = User::where('email',$email)->first();
    if($user){
      Mail::to($email)->send(new ResetPasswordEmail($user));
    }
    //cannot find the registed email
    return -1;
  }

  public static function create_with_request($request){
    $user = UserService::create($request->name,$request->email,$request->password,$request->birthYear,$request->gender,null);

    $exp = 107;
    $articleCount = 0;
    $discussionCount = 0;

    $userAchieveInfo = UserAchievementService::set_user_achievement_info($user->id,$exp,$articleCount,$discussionCount);

    UserAchievementService::set_achievement_by_achivevement_info($userAchieveInfo);

    UserService::set_permission_for_normal($user->id);

    UserService::send_verify_email_with_user($user);

    return $user;
  }

  public static function create($name,$email,$password,$birthYear,$gender,$avatarURL){
    $user = new User;
    $user->name = $name;
    $user->email = $email;
    $user->password = Hash::make($password);
    $user->birthYear = $birthYear;
    $user->gender = $gender;
    $user->verified_email_token = str_random(40);
    $user->password_reset_token = str_random(80);

    if(!$avatarURL){
      $avatarURL = self::USER_DEFAULT_AVATAR;
    }

    $user->avatarURL = $avatarURL;
    $user->save();

    return $user;
  }

  public static function update_password($request){
    $current_password = Auth::user()->password;
    if(Hash::check($request->current_password,$current_password)){
      $user = Auth::user();
      $user->password = Hash::make($request->new_password);
      $user->save();
      return 0;
    }
    return -1;
  }

  public static function update_profile($request){
    $filter_request = array_filter($request->all(),function($item_value){
      if($item_value == ""){
        return false;
      }
      return true;
    });
    Auth::user()->update($filter_request);
    return 0;
  }

  public static function get_user_by_id($user_id){
    return User::find($user_id);
  }
}
 ?>
