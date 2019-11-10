<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;
use App\Http\Services\UserService;
use App\Http\Services\ArticleService;

$factory->define(Article::class, function (Faker $faker) {
    $user_range = UserService::getUserIDRange();
    $subject_range = ArticleService::getSubjectIDRange();
    $content = $faker->paragraphs($nb = 10, $asText = true);
    $wordCount = strlen($content);

    return [
      'title' => $faker->sentences($nd=1,$asText=true),
      'cover_url' => $faker->imageUrl($width = 640, $height = 480),
      'subject_id' => $faker->numberBetween($min = 1, $max = 100),
      'content' => $content,
      'wordCount' => $wordCount,
      'user_id' => $faker->numberBetween($min = $user_range[0], $max = $user_range[1])
    ];
});
