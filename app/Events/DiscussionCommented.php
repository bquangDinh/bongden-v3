<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DiscussionCommented implements ShouldBroadcast
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
    public function __construct($user,$discussion,$comment)
    {
        $this->user = $user;
        $this->message = "{$user->name} đã bình luận vào bài thảo luận của bạn: {$discussion->title}";
        $this->url = "/discussion/{$discussion->id}/#cm-bl-{$comment->id}";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['discussion-commented'];
    }

    public function broadcastAs(){
      return 'discussion-commented-event';
    }
}
