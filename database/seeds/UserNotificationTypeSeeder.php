<?php

use Illuminate\Database\Seeder;

use App\UserNotificationType;

class UserNotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
          "like_discussion",
          "like_comment_article",
          "like_reply_article",
          "reply_comment_article",
          "reply_reply_article",
          "upvote_discussion",
          "downvote_discussion",
          "comment_article",
          "comment_discussion",
          "like_comment_discussion",
          "like_reply_discussion",
          "reply_comment_discussion",
          "reply_reply_discussion"
        );

        foreach($types as $type){
          $new = new UserNotificationType;
          $new->name = $type;
          $new->save();
        }
    }
}
