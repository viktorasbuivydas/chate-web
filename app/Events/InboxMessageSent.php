<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InboxMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ConversationMessage $chat
    ) {
    }

    public function broadcastOn(): array
    {
        return ['chat'];
    }

    public function broadcastAs(): string
    {
        return 'message-sent';
    }


}
