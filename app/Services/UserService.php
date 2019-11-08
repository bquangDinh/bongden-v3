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
  public static function create($request){
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->birthYear = $request->birthYear;
    $user->gender = $request->gender;
    $user->avatarURL = asset('sources/images/protected/logo.png');
    $user->save();

    $userAchieveInfo = UserAchievementService::setUserAchievementInfo($user->id,2,0,0);

    UserAchievementService::setUserAchievementByInfo($userAchieveInfo);

    $userToRole = new UserToRole;
    $userToRole->user_id = $user->id;
    $role = UserRole::where('name','=','normal')->firstOrFail(); // normal guys
    $userToRole->role_id = $role->id;
    $userToRole->save();

    return $user;
  }
}
 ?>
