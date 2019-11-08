<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ArticleSubject;
use Faker\Generator as Faker;

$factory->define(ArticleSubject::class, function (Faker $faker) {
  return [
      'name' => $faker->unique()->jobTitle()
  ];
});
