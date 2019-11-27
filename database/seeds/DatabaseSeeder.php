<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*Seeders can be called in both*/ /*Run  this first*/
        /*In order*/

        $this->call(UserPermissionSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UroleUpermissionSeeder::class);
        $this->call(DiscussionCategorySeeder::class);

        $this->call(AchievementListSeeder::class);
        $this->call(AchievementRoleSeeder::class);
        $this->call(AchievementRoleToListSeedder::class);

        $this->call(UserNotificationTypeSeeder::class);
        /*--------------------------*/

        /*Seeders in production stage*/ /*Run this second*/
        /*Only run User seeder in production stage. Comment it in release stage*/
        //$this->call(UserSeeder::class);

        //$this->call(ArticleSubjectSeeder::class);
        //$this->call(ArticleTagSeeder::class);
        //$this->call(ArticleSeeder::class);
        //$this->call(DiscussionSeeder::class);

        /*------------------------------*/

        /*Seeders in release stage*/
    }
}
