<?php

namespace App\Events;

use App\Models\ConversationMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InboxMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ConversationMessage $conversationMessage
    ) {
    }

    public function broadcastOn(): array
    {
        $this->conversationMessage->loadMissing('conversation');
        return ['notifications.' . $this->conversationMessage->conversation->uuid];
    }

    public function broadcastAs(): string
    {
        return 'inbox-message-sent';
    }
}
