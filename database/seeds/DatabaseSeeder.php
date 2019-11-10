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
        /*Seeders in production stage*/
        /*Only run User seeder in production stage. Comment it in release stage*/
        //$this->call(UserSeeder::class);

        //$this->call(ArticleSubjectSeeder:class);
        //this->call(ArticleTagSeeder::class);
        $this->call(ArticleSeeder::class);

        /*Seeders in release stage*/
    }
}
