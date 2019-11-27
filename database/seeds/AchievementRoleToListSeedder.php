<?php

use Illuminate\Database\Seeder;

use App\UARoleToUAList;

class AchievementRoleToListSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numOfAchievement = 39;
        for($index = 1;$index <= $numOfAchievement;$index++){
          $new = new UARoleToUAList;
          $new->role_id = $index;
          $new->achievement_id = $index;
          $new->save();
        }
    }
}
