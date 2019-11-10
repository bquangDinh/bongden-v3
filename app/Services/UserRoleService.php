<?php
namespace App\Http\Services;

use App\UserPermission;
use App\UserRole;
use App\UserToRole;
use App\URoleToUPermission;

class UserRoleService{
  public static function create_first_role($user_id){
    $userToRole = new UserToRole;
    $userToRole->user_id = $user_id;
    $role = UserRole::where('name','=','normal')->firstOrFail(); // normal guys
    $userToRole->role_id = $role->id;
    $userToRole->save();
    return $userToRole;
  }
}
 ?>
