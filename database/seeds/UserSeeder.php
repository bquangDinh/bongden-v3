<?php

use Illuminate\Database\Seeder;
use App\Http\Services\UserAchievementService;
use App\Http\Services\UserService;

use Faker\Factory as Faker;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

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
        $faker = Faker::create();
        for($i = 0; $i < $numUsers;$i++){
          $request = new Request([
              'name' => $faker->name,
              'email' => $faker->unique()->safeEmail,
              'birthYear' => date('Y'),
              'gender' => $faker->randomElement($array = array('male','famale')),
              'avatarURL' => 'https://www.pcgamesn.com/wp-content/uploads/2019/04/Astroneer-My-base-900x506.jpg',
              'password' => 'password', // password
              'remember_token' => Str::random(10),
          ]);

          UserService::create_with_request($request);
        }
    }
}
