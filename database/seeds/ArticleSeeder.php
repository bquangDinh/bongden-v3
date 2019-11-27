<?php

use Illuminate\Database\Seeder;
use App\Http\Services\UserAchievementService;
use App\Http\Services\ArticleService;

use Illuminate\Http\Request;

use Faker\Factory as Faker;

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
        $faker = Faker::create();
        for($i = 0; $i < $numArticles;$i++){
            $content = $faker->paragraphs($nb = 10, $asText = true);
            $wordCount = strlen($content);
            $request = new Request([
              'title' => $faker->sentences($nd=1,$asText=true),
              'cover' => $faker->imageUrl($width = 640, $height = 480),
              'subject' => $faker->numberBetween($min = 1, $max = 100),
              'content' => $content,
              'wordCount' => $wordCount,
              'submit' => $faker->randomElement($array = array('save','upload','uploaded')),
              'tag' => [$faker->numberBetween($min = 1, $max = 100)]
            ]);
            $user_id = $faker->numberBetween($min = 1, $max = 50);
            ArticleService::create_article_with_request($user_id,$request);
        }
    }
}
