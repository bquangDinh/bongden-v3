<?php
namespace App\Http\Services;

use App\UserAchievement;
use App\UserAchievementInfo;
use App\UserAchievementList;
use App\UserAchievementToRole;
use App\UserAchievementRole;
use App\UARoleToUAList;
use App\UserFollower;

class UserAchievementService{
  const LEVEL_UP_CONS = 0.8;

  public static function calculateLevel($exp){
    $level = self::LEVEL_UP_CONS * sqrt($exp);
    $level = intval($level);
    return $level;
  }

  public static function calculateExpToNextLevel($currentLevel){
    $nextLevel = $currentLevel + 1;
    $exp = pow(($nextLevel / self::LEVEL_UP_CONS),2);
    return intval($exp);
  }

  public static function addAchievementRole($from_exp,$to_exp,$articleCount,$followerCount){
    $achievementRole = new UserAchievementRole;
    $achievementRole->from_exp = $from_exp;
    $achievementRole->to_exp = $to_exp;
    $achievementRole->articleCount = $articleCount;
    $achievementRole->followerCount = $followerCount;
    $achievementRole->save();
    return $achievementRole;
  }

  public static function setUserAchievementInfo($user_id,$exp,$articleCount,$followerCount){
    $userAchieveInfo = UserAchievementInfo::firstOrNew(['user_id' => $user_id]);
    $userAchieveInfo->user_id = $user_id;
    $userAchieveInfo->exp = $exp;
    $userAchieveInfo->level = UserAchievementService::calculateLevel($exp);
    $userAchieveInfo->articleCount = $articleCount;
    $userAchieveInfo->followerCount = $followerCount;
    $userAchieveInfo->save();
    return $userAchieveInfo;
  }

  public static function setUserAchievementToRole($userAchieveInfo){
    $roles = UserAchievementService::getRolesByAchieveInfo($userAchieveInfo);

    $userATRs = array();

    foreach ($roles as $role) {
      if(!UserAchievementToRole::where(['user_id' => $userAchieveInfo->user_id,'role_id' => $role->id])->first()){
        $userATR = new UserAchievementToRole;
        $userATR->user_id = $userAchieveInfo->user_id;
        $userATR->role_id = $role->id;
        $userATR->save();
        array_push($userATRs,$userATR);
      }
    }

    return $userATRs;
  }

  public static function getRolesByAchieveInfo($userAchieveInfo){
    $roles = UserAchievementRole::orWhere([
      ['level', '=', $userAchieveInfo->level]
    ])->orWhere([
      ['articleCount', '=', $userAchieveInfo->articleCount]
    ])->orWhere([
      ['followerCount', '=', $userAchieveInfo->followerCount]
    ])->get();

    return $roles;
  }

  public static function getAchievementByRole($role_id){
    $uARRL = UARoleToUAList::where('role_id','=',$role_id)->firstOrFail();
    return $uARRL->achievement_id;
  }

  public static function setUserAchievementByInfo($userAchieveInfo){
    $uATRs = UserAchievementService::setUserAchievementToRole($userAchieveInfo);

    foreach($uATRs as $uATR){
      $achievement_id = UserAchievementService::getAchievementByRole($uATR->role_id);
      if(!UserAchievement::where(['user_id' => $uATR->user_id,'achievement_id' => $achievement_id])->first()){
        $userAchievement = new UserAchievement;
        $userAchievement->user_id = $uATR->user_id;
        $userAchievement->achievement_id = $achievement_id;
        $userAchievement->save();
      }
    }
  }

  public static function getArticleCount($user_id){
    $userAchievementInfo = UserAchievementInfo::where('user_id','=',$user_id)->firstOrFail();
    return $userAchievementInfo->articleCount;
  }

  public static function getArticleInWeek($user_id){

  }
}
 ?>
