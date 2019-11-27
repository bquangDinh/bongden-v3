<?php
namespace App\Http\Services;

use App\UserNotification;
use App\UserNotificationType;
use App\User;

use App\Events\DiscussionLiked;
use App\Events\DiscussionUpvoted;
use App\Events\DiscussionDownvoted;
use App\Events\ArticleCommented;
use App\Events\CommentLikedArticle;
use App\Events\CommentLikedDiscussion;
use App\Events\CommentRepliedArticle;
use App\Events\CommentRepliedDiscussion;
use App\Events\DiscussionCommented;
use App\Events\ReplyLikedArticle;
use App\Events\ReplyLikedDiscussion;
use App\Events\ReplyRepliedArticle;
use App\Events\ReplyRepliedDiscussion;

class NotificationService{

  const TYPE_LIKE_DISCUSSION = "like_discussion";
  const TYPE_LIKE_COMMENT_ARTICLE = "like_comment_article";
  const TYPE_LIKE_REPLY_ARTICLE = "like_reply_article";
  const TYPE_REPLY_COMMENT_ARTICLE = "reply_comment_article";
  const TYPE_REPLY_REPLY_ARTICLE = "reply_reply_article";
  const TYPE_UPVOTE_DISCUSSION = "upvote_discussion";
  const TYPE_DOWNVOTE_DISCUSSION = "downvote_discussion";
  const TYPE_COMMENT_ARTICLE = "comment_article";
  const TYPE_COMMENT_DISCUSSION = "comment_discussion";
  const TYPE_LIKE_COMMENT_DISCUSSION = "like_comment_discussion";
  const TYPE_LIKE_REPLY_DISCUSSION = "like_reply_discussion";
  const TYPE_REPLY_COMMENT_DISCUSSION = "reply_comment_discussion";
  const TYPE_REPLY_REPLY_DISCUSSION = "reply_reply_discussion";

  public static function send_notification_discussion_liked($actor,$discussion){
    $notification_event = new DiscussionLiked($actor,$discussion);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_LIKE_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_discussion_upvoted($actor,$discussion){
    $notification_event = new DiscussionUpvoted($actor,$discussion);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_UPVOTE_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_discussion_downvoted($actor,$discussion){
    $notification_event = new DiscussionDownvoted($actor,$discussion);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_DOWNVOTE_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_article_commented($actor,$article,$comment){
    $notification_event = new ArticleCommented($actor,$article,$comment);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_COMMENT_ARTICLE)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $article->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_comment_liked_article($actor,$article,$comment){
    $notification_event = new CommentLikedArticle($actor,$article,$comment);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_LIKE_COMMENT_ARTICLE)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $article->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_comment_liked_discussion($actor,$discussion,$comment){
    $notification_event = new CommentLikedDiscussion($actor,$discussion,$comment);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_LIKE_COMMENT_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_comment_replied_article($actor,$article,$reply){
    $notification_event = new CommentRepliedArticle($actor,$article,$reply);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_REPLY_COMMENT_ARTICLE)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $article->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_comment_replied_discussion($actor,$discussion,$reply){
    $notification_event = new CommentRepliedDiscussion($actor,$discussion,$reply);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_REPLY_COMMENT_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_discussion_commented($actor,$discussion,$comment){
    $notification_event = new DiscussionCommented($actor,$discussion,$comment);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_COMMENT_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_reply_liked_article($actor,$article,$reply){
    $notification_event = new ReplyLikedArticle($actor,$article,$reply);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_LIKE_REPLY_ARTICLE)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $article->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_reply_liked_discussion($actor,$discussion,$reply){
    $notification_event = new ReplyLikedDiscussion($actor,$discussion,$reply);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_LIKE_REPLY_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_reply_replied_article($actor,$article,$reply){
    $notification_event = new ReplyRepliedArticle($actor,$article,$reply);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_REPLY_REPLY_ARTICLE)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $article->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function send_notification_reply_replied_discussion($actor,$discussion,$reply){
    $notification_event = new ReplyRepliedDiscussion($actor,$discussion,$reply);

    $notification = new UserNotification;
    $type = UserNotificationType::where('name',self::TYPE_REPLY_REPLY_DISCUSSION)->firstOrFail();
    $notification->notification_type_id = $type->id;
    $notification->actor_id = $actor->id;
    $notification->message = $notification_event->message;
    $notification->notifier_id = $discussion->author->id;
    $notification->url = $notification_event->url;
    $notification->save();

    event($notification_event);

    return 0;
  }

  public static function mark_as_read_notification($notification_id){
    $notification = UserNotification::find($notification_id);
    if($notification){
      $notification->read = true;
      $notification->save();
    }
    return 0;
  }
}
