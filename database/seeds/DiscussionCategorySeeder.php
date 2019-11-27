<?php

use Illuminate\Database\Seeder;
use App\DiscussionCategory;

class DiscussionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = array(
        "FAQ",
        "Phản hồi",
        "Bài tập"
      );

      foreach($categories as $category){
        $c = new DiscussionCategory;
        $c->name = $category;
        $c->save();
      }
    }
}
