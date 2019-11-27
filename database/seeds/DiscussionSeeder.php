<?php

use Illuminate\Database\Seeder;
use App\Http\Services\DiscussionService;
use Illuminate\Http\Request;

use Faker\Factory as Faker;

class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $numDiscussions = 100;
      $faker = Faker::create();
      for($i = 0; $i < $numDiscussions;$i++){
          $content = $faker->paragraphs($nb = 10, $asText = true);
          $wordCount = strlen($content);
          $request = new Request([
            'title' => $faker->sentences($nd=1,$asText=true),
            'thread_category_id' => $faker->numberBetween($min = 1, $max = 2),
            'content' => $content,
            'wordCount' => $wordCount
          ]);
          $user_id = $faker->numberBetween($min = 1, $max = 50);
          DiscussionService::create_discussion_with_request($user_id,$request);
      }
    }
}
