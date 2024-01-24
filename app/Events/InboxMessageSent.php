<?php

namespace App\Events;

use App\Models\ConversationMessage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InboxMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public ConversationMessage $conversationMessage
    )
    {
    }

    public function broadcastOn(): array
    {
        $this->conversationMessage->loadMissing([
            'conversation',
            'conversation.members' => function ($query) {
                $query->whereNot('user_id', $this->conversationMessage->user_id);
            }
        ]);

        // broadcast on all other members except the sender
        return $this->conversationMessage->conversation->members->map(function ($member) {
            return new PrivateChannel('notifications.' . $member->uuid);
        })->toArray();

    }

    public function broadcastAs(): string
    {
        return 'inbox-message-sent';
    }
}
