<?php
namespace App\Http\Services;

use App\Http\Services\UserAchievementService;

use Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\UserPermission;
use App\UserRole;
use App\UserToRole;
use App\URoleToUPermission;

class UserService{
  /*User Roles and Permission*/
  public static function set_permission_for_normal($user_id){
    $userToRole = UserToRole::where('user_id',$user_id)->first();
    $role = UserRole::where('name','=','normal')->firstOrFail(); // normal guys

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

  public static function create_with_request($request){
    $user = UserService::create($request->name,$request->email,$request->password,$request->birthYear,$request->gender,null);

    $exp = 2;
    $articleCount = 0;
    $followerCount = 0;

    $userAchieveInfo = UserAchievementService::set_user_achievement_info($user->id,$exp,$articleCount,$followerCount);

    UserAchievementService::set_achievement_by_achivevement_info($userAchieveInfo);

    UserService::set_permission_for_normal($user->id);

    return $user;
  }

  public static function create($name,$email,$password,$birthYear,$gender,$avatarURL){
    $user = new User;
    $user->name = $name;
    $user->email = $email;
    $user->password = Hash::make($password);
    $user->birthYear = $birthYear;
    $user->gender = $gender;

    if(!$avatarURL){
      $avatarURL = asset('sources/images/protected/logo.png');
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
}
 ?>
