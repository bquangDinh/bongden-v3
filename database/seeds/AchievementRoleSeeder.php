<?php

use Illuminate\Database\Seeder;

use App\UserAchievementRole;

class AchievementRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
          "1,0,0",
          "2,-1,-1",
          "3,-1,-1",
          "5,-1,-1",
          "7,-1,-1",
          "11,-1,-1",
          "13,-1,-1",
          "17,-1,-1",
          "19,-1,-1",
          "23,-1,-1",
          "29,-1,-1",
          "31,-1,-1",
          "37,-1,-1",
          "41,-1,-1",
          "43,-1,-1",
          "47,-1,-1",
          "53,-1,-1",
          "59,-1,-1",
          "61,-1,-1",
          "67,-1,-1",
          "71,-1,-1",
          "73,-1,-1",
          "79,-1,-1",
          "83,-1,-1",
          "89,-1,-1",
          "-1,1,-1",
          "-1,-1,1",
          "-1,2,-1",
          "-1,4,-1",
          "-1,5,-1",
          "-1,6,-1",
          "-1,10,-1",
          "-1,14,-1",
          "-1,20,-1",
          "-1,30,-1",
          "-1,-1,3",
          "-1,-1,7",
          "-1,-1,10",
          "-1,-1,14"
        );

        foreach ($roles as $role) {
          $new = new UserAchievementRole;
          $conditions = explode(",",$role);
          $new->level = $conditions[0];
          $new->articleCount = $conditions[1];
          $new->discussionCount = $conditions[2];
          $new->save();
        }
    }
}
