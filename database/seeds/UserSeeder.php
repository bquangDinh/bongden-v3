<?php

use Illuminate\Database\Seeder;
use App\Http\Services\UserAchievementService;
use App\Http\Services\UserRoleService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numUsers = 50;
        factory(App\User::class,$numUsers)->create()->each(function($user){
          $userAchieveInfo = UserAchievementService::setUserAchievementInfo($user->id,2,0,0);
          UserAchievementService::setUserAchievementByInfo($userAchieveInfo);
          UserRoleService::create_first_role($user->id);
        });
    }
}
