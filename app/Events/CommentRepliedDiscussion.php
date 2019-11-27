<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentRepliedDiscussion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $url;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$discussion,$reply)
    {
        $this->user = $user;
        $this->message = "{$user->name} đã trả lời bình luận của bạn trên bài thảo luận: {$discussion->title}";
        $this->url = "/discussion/{$discussion->id}/#rl-bl-{$reply->id}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['comment-replied-discussion'];
    }

    public function broadcastAs(){
      return 'comment-replied-discussion-event';
    }
}
