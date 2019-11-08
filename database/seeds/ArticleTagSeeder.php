<?php

use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         $numTag = 100;
         factory(App\ArticleTag::class,$numTag)->create();
     }
}
