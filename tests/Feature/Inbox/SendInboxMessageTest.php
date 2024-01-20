<?php

namespace Tests\Feature\Inbox;

use App\Events\InboxMessageSent;
use App\Events\MessageSent;
use App\Models\ConversationMessage;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SendInboxMessageTest extends TestCase
{
    public function test_user_can_send_inbox_message()
    {
        Event::fake();
        $conversationMessage = ConversationMessage::factory()->create();

        $conversationMessage->load('conversation', 'sender', 'receiver');
        $conversation = $conversationMessage->conversation;

        $this->actingAs($conversationMessage->sender)
            ->post(route('app.inbox.store', $conversation->uuid), [
                'receiver_id' => $conversationMessage->receiver->id,
                'message' => 'Hello, World!',
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('conversation_messages', [
            'conversation_id' => $conversation->id,
            'sender_id' => $conversationMessage->sender->id,
            'receiver_id' => $conversationMessage->receiver->id,
            'message' => 'Hello, World!',
        ]);

        Event::assertDispatched(InboxMessageSent::class);
    }

    public function test_validation_works_properly()
    {
        $conversationMessage = ConversationMessage::factory()->create();
        $conversationMessage->load('conversation', 'sender', 'receiver');
        $conversation = $conversationMessage->conversation;

        $this->assertDatabaseCount('conversation_messages', 1);

        $this->actingAs($conversationMessage->sender)
            ->post(route('app.inbox.store', $conversation->uuid))
            ->assertStatus(302)
            ->assertSessionHasErrors(['message', 'receiver_id']);

        $this->actingAs($conversationMessage->sender)
            ->post(route('app.inbox.store', $conversation->uuid), [
                'receiver_id' => $conversationMessage->receiver->id,
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['message']);

        $this->assertDatabaseCount('conversation_messages', 1);
        $this->assertDatabaseCount('conversations', 1);
    }
}
