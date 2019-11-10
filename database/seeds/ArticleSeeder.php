<?php

use Illuminate\Database\Seeder;
use App\Http\Services\UserAchievementService;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numArticles = 100;
        factory(App\Article::class,$numArticles)->create()->each(function($article){
          //set state
          $article->author->achieveDetail->increment('articleCount');
          $userAchieveInfo = $article->author->achieveDetail;
          UserAchievementService::setUserAchievementByInfo($userAchieveInfo);
        });
    }
}
