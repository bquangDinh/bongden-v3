<?php
namespace App\Http\Services;

use App\UserAchievement;
use App\UserAchievementInfo;
use App\UserAchievementList;
use App\UserAchievementToRole;
use App\UserAchievementRole;
use App\UARoleToUAList;
use App\UserFollower;
use App\User;

use App\Http\Services\ArticleService;

class UserAchievementService{
  const LEVEL_UP_CONS = 0.8;
  const ARTICLE_EXP = 10;
  const DISCUSSION_EXP = 5;

  /*Level and exp calculation helper*/

  //Precondition: $exp must be positive.
  //Postcondition: the function will calculate the corresponding level and then return the level.
  public static function calculate_level($exp){
    $level = self::LEVEL_UP_CONS * sqrt($exp);
    $level = intval($level);
    return $level;
  }

  //Precondition: $current_level must be positive.
  //Postcondition: the function will calculate how much needing exp to the next level and then return the exp amount.
  public static function calculate_exp_to_next_level($current_level){
    $next_level = $current_level + 1;
    $exp = pow(($next_level / self::LEVEL_UP_CONS),2);
    $exp = intval($exp);
    return $exp;
  }

  public static function calculate_exp_percentage_to_next_level($user_id){
    $user = User::find($user_id);
    $userAchieveInfo = $user->achieveDetail;
    $current_exp = $userAchieveInfo->exp;
    $next_exp = UserAchievementService::calculate_exp_to_next_level($userAchieveInfo->level);
    $percentage = ($current_exp / $next_exp);
    return $percentage;
  }

  /*---------------------------------------*/

  //Precondition: $user_id must be found in User table. Otherwise the funtion will be terminated.
  //$exp must be positive.
  //$articleCount must be positive.
  //$followerCount must be positive.
  //Precondition: the function will find the user achievement info record by user_id. Otherwise it will create a new one
  //fill all the provided infomation to the record and then return it.
  public static function set_user_achievement_info($user_id,$exp,$articleCount,$followerCount){
    $userAchieveInfo = UserAchievementInfo::firstOrNew(['user_id' => $user_id]);
    $userAchieveInfo->user_id = $user_id;
    $userAchieveInfo->exp = $exp;
    $userAchieveInfo->level = UserAchievementService::calculate_level($exp);
    $userAchieveInfo->articleCount = $articleCount;
    $userAchieveInfo->discussionCount = $followerCount;
    $userAchieveInfo->save();
    return $userAchieveInfo;
  }

  //Precondition: $user_id must be found in User table.
  //Postcondition: the function will return the user achievement info record
  //if it cannot find the record => return null.
  public static function get_user_achievement_info($user_id){
    $userAchieveInfo = UserAchievementInfo::where('user_id',$user_id)->first();
    return $userAchieveInfo;
  }

  /*achivement and role function*/

  //Precondition: $level,$articleCount,$followerCount must be positive.
  //Postcondition: the function will create a new record, fill out all provided infomation and then return it.
  public static function add_achievement_role($level,$articleCount,$followerCount){
    $achievementRole = new UserAchievementRole;
    $achievementRole->level = $level;
    $achievementRole->articleCount = $articleCount;
    $achievementRole->followerCount = $followerCount;
    $achievementRole->save();
    return $achievementRole;
  }

  //Precondition: $userAchieveInfo must be found in UserAchievementInfo table.
  //Postcondition: the function will take all corresponding roles follow by the achievement info and then return it as array.
  public static function get_roles_by_achievement_info($userAchieveInfo){
    $roles = array();
    $rolesWithLevel = UserAchievementRole::where('level','=',$userAchieveInfo->level)->get();
    $rolesWithArticleCount = UserAchievementRole::where('articleCount','=',$userAchieveInfo->articleCount)->get();
    $rolesWithDiscussionCount = UserAchievementRole::where('discussionCount','=',$userAchieveInfo->followerCount)->get();

    foreach($rolesWithLevel as $role){
      array_push($roles,$role);
    }

    foreach($rolesWithArticleCount as $role){
      array_push($roles,$role);
    }

    foreach($rolesWithDiscussionCount as $role){
      array_push($roles,$role);
    }

    return $roles;
  }

  //Precondition: $userAchievementInfo must be found in UserAchievementInfo table.
  //Postcondition: The function will take all corresponding roles by $userAchieveInfo, set new role to table
  //if the user doesn't have it, and then return all found results as array.
  public static function set_user_achievement_to_role($userAchieveInfo){
    $roles = UserAchievementService::get_roles_by_achievement_info($userAchieveInfo);

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

  //Precondition: $role_id must be found in UserAchivementRole table.
  //Postcondition: The function will find the corresponding achievement by role in UARoleToUAList table
  //and then return the record.
  public static function get_achievement_by_role($role_id){
    $uARRL = UARoleToUAList::where('role_id','=',$role_id)->firstOrFail();
    return $uARRL;
  }

  //Precondition: $userAchieveInfo must be found in UserAchievementInfo table.
  //Postcondition: The function will set corresponding achievements by user achievement info.
  //follow by UARoleToUAList
  public static function set_achievement_by_achivevement_info($userAchieveInfo){
    $uATRs = UserAchievementService::set_user_achievement_to_role($userAchieveInfo);

    foreach($uATRs as $uATR){
      $uARRL = UserAchievementService::get_achievement_by_role($uATR->role_id);
      if(!UserAchievement::where(['user_id' => $uATR->user_id,'achievement_id' => $uARRL->achieve->id])->first()){
        $userAchievement = new UserAchievement;
        $userAchievement->user_id = $uATR->user_id;
        $userAchievement->achievement_id = $uARRL->achieve->id;
        $userAchievement->save();
      }
    }
  }

  /*Getter User Achievement Info helper*/

  //Precondition: $user_id must be valid and be found in User table.
  //Postcondition: The function will get the user achievement info, get the articleCount property
  //and then return the result.
  //If the function cannot find the corresponding user achievement info by user_id. It will be terminated.
  public static function get_article_count_by_user_id($user_id){
    $userAchievementInfo = UserAchievementInfo::where('user_id','=',$user_id)->firstOrFail();
    return $userAchievementInfo->articleCount;
  }

  //Precondition: $user_id must be valid and be found in User table.
  //Postcondition: The function will get the user achievement info, get the followerCount property
  //and then return the result.
  //If the function cannot find the corresponding user achievement info by user_id. It will be terminated.
  public static function get_follower_count_by_user_id($user_id){
    $userAchievementInfo = UserAchievementInfo::where('user_id','=',$user_id)->firstOrFail();
    return $userAchievementInfo->followerCount;
  }

  //Precondition: $user_id must be valid and be found in User table.
  //Postcondition: The function will get the user achievement info, get the current exp of the user
  //and then return the result.
  //If the function cannot find the corresponding user achievement info by user_id. It will be terminated.
  public static function get_exp_by_user_id($user_id){
    $userAchievementInfo = UserAchievementInfo::where('user_id','=',$user_id)->firstOrFail();
    return $userAchievementInfo->exp;
  }

  //Precondition: $user_id must be valid and be found in User table.
  //Postcondition: The function will get the user achievement info, get the current level of the user
  //and then return the result.
  //If the function cannot find the corresponding user achievement info by user_id. It will be terminated.
  public static function get_level_by_user_id($user_id){
    $userAchievementInfo = UserAchievementInfo::where('user_id','=',$user_id)->firstOrFail();
    return $userAchievementInfo->level;
  }
  /*-------------------------*/

  //Precondition: valid user achievement info. It means the achievement info record must be found in database
  //valid article_id. It means the article must be found in database.
  //Postcondition: Function will check if the article is uploaded and increase article count in the found record,
  //then increase the exp that will follow. Update achievement of the user if the user achievement info adapt to the roles.
  //the ARTICLE_EXP rule and return the record for other using. Otherwise return the unchanging user achievement info.
  public static function increase_article($userAchieveInfo, $article_id){
    $isUploaded = ArticleService::is_uploaded_article($article_id);

    if($isUploaded){
      //will be added later
    }

    $userAchieveInfo->increment('articleCount');
    $newExp = $userAchieveInfo->exp + self::ARTICLE_EXP;
    $newLevel = UserAchievementService::calculate_level($newExp);
    $userAchieveInfo->exp = $newExp;
    $userAchieveInfo->level = $newLevel;
    $userAchieveInfo->save();

    UserAchievementService::set_achievement_by_achivevement_info($userAchieveInfo);

    return $userAchieveInfo;
  }

  //Precondition: valid user id. It means the user record must be found in database.
  //valid article_id. It means the article must be found in database.
  //Postcondition: Function will find the corresponding user achivement info record by user_id
  //it will check the article is uploaded, increase article count in the found record, then increase the exp that will follow
  //the ARTICLE_EXP rule and return the record for other using. Otherwise the unchanging user achivement info will be returned.
  public static function increase_article_by_user_id($user_id,$article_id){
    $userAchieveInfo = UserAchievementInfo::where('user_id',$user_id)->firstOrFail();
    $updated = UserAchievementService::increase_article($userAchieveInfo,$article_id);
    return $updated;
  }

  //Precondition: $userAchieveInfo is the user achievement info in UserAchievementInfo table
  //Postcondition: The function will decrease the article count of the user achievement info.
  public static function decrease_article($userAchieveInfo){
    $userAchieveInfo->decrement('articleCount');
    $userAchieveInfo->save();

    return $userAchieveInfo;
  }

  //Precondition: valid user id. It means the user record must be found in database.
  //valid article_id. It means the article must be found in database.
  //Postcondition: Function will find the corresponding user achivement info record by user_id
  //decrease the article count.
  public static function decrease_article_by_user_id($user_id){
    $userAchieveInfo = UserAchievementInfo::where('user_id',$user_id)->firstOrFail();
    $updated = UserAchievementService::decrease_article($userAchieveInfo);
    return $updated;
  }

  //Precondition: valid user achievement info. It means the achievement info record must be found in database
  //Postcondition: Increase discussion count in user achievement info record,
  //then increase the exp that will follow. Update achievement of the user if the user achievement info adapt to the roles.
  //the DISCUSSION_EXP rule and return the record for other using.
  public static function increase_discussion($userAchieveInfo){
    $userAchieveInfo->increment('discussionCount');
    $newExp = $userAchieveInfo->exp + self::DISCUSSION_EXP;
    $newLevel = UserAchievementService::calculate_level($newExp);
    $userAchieveInfo->exp = $newExp;
    $userAchieveInfo->level = $newLevel;
    $userAchieveInfo->save();

    UserAchievementService::set_achievement_by_achivevement_info($userAchieveInfo);

    return $userAchieveInfo;
  }

  public static function increase_discussion_by_user_id($user_id){
    $userAchieveInfo = UserAchievementInfo::where('user_id',$user_id)->firstOrFail();
    $updated = UserAchievementService::increase_discussion($userAchieveInfo);
    return $updated;
  }

  //Precondition: $user_id must be found in User table.
  //$user_id is the ID of the user in User table.
  //$month lies in range 1 <= $month <= 12
  //$year must be positive, start from 2018 to now
  //Postcondition: The function will count articles in the month of the given year and then return the result.
  //If the function receive a invalid month. -1 will be returned.
  //If thr function receive a invalid year. -1 will be returned.
  public static function get_articles_count_by_month($user_id,$month,$year){
    if($month < 1 || $month > 12){
      return -1;
    }

    if($year < 2018 || $year > date('Y')){
      return -1;
    }

    $articles = User::findOrFail($user_id)->articles;
    $count = 0;

    foreach($articles as $article){
      if(date('n',strtotime($article->created_at)) == $month && date('Y',strtotime($article->created_at)) == $year){
        $count++;
      }
    }
    return $count;
  }

  //Precondition:$user_id must be found in User table.
  //$user_id is the ID of the user in User table.
  //$year must be positive, start from 2018 to now
  //if $year is null, the year of now will be returned
  //if $year is invalid, the empty array will be returned
  //Postcondition: collect all article count by month in the given year
  //and then return the result as array
  public static function get_articles_count_statistics($user_id,$year){
    $article_count = array();

    if($year == null){
      $year = date('Y');
    }

    if($year < 2018 || $year > date('Y')){
      return $article_count;
    }

    for($month = 1;$month <= 12;$month++){
      $count = UserAchievementService::get_articles_count_by_month($user_id,$month,$year);
      array_push($article_count,$count);
    }

    return $article_count;
  }

  //Precondition: $user_id must be found in User table.
  //$user_id is the ID of the user in User table.
  //Postcondition: The function will
  public static function get_article_count_by_subject_statistics($user_id){
    $articles = User::findOrFail($user_id)->articles;
    $article_count = array();

    foreach($articles as $article){
      if(isset($article_count[$article->subject->name])){
        $article_count[$article->subject->name] += 1;
      }else{
        $article_count[$article->subject->name] = 1;
      }
    }

    return $article_count;
  }

  //Precondition: $user_id must be found in User table.
  //$user_id is the ID of the user in User table.
  //Postcondition: The function will look at the UserAchievementRole table and find the next role by level condition
  //And then get the corresponding achievement and return the achievement
  public static function get_next_medal_by_level($user_id){
    $userAchieveInfo = UserAchievementInfo::where('user_id',$user_id)->firstOrFail();
    $current_level = $userAchieveInfo->level;
    $role_for_next_medal = UserAchievementRole::where('level','>',$current_level)->first();
    $uA = UserAchievementService::get_achievement_by_role($role_for_next_medal->id);
    $achieve = $uA->achieve;
    return $achieve;
  }
}
 ?>
