<?php

use Illuminate\Database\Seeder;

class ArticleSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $numSubject = 100;
      factory(App\ArticleSubject::class,$numSubject)->create();
    }
}
