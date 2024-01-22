<?php

namespace Tests\Feature\Inbox;

use App\Events\InboxMessageSent;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SendInboxMessageTest extends TestCase
{
    public function test_user_can_send_inbox_message()
    {
        Event::fake();
        $conversation = Conversation::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('app.conversations.messages.store', $conversation->uuid), [
                'conversation' => $conversation->uuid,
                'user_id' => $user->id,
                'message' => 'Hello, World!',
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('conversation_messages', [
            'conversation_id' => $conversation->id,
            'user_id' => $user->id,
            'message' => 'Hello, World!',
        ]);

        Event::assertDispatched(InboxMessageSent::class);
    }

    public function test_validation_works_properly()
    {
        $conversationMessage = ConversationMessage::factory()->create();
        $conversationMessage->load('conversation', 'user');
        $conversation = $conversationMessage->conversation;

        $this->assertDatabaseCount('conversation_messages', 1);

        $this->actingAs($conversationMessage->user)
            ->post(route('app.conversations.messages.store', $conversation->uuid))
            ->assertStatus(302)
            ->assertSessionHasErrors(['message', 'user_id']);

        $this->actingAs($conversationMessage->user)
            ->post(route('app.conversations.messages.store', $conversation->uuid), [
                'conversation' => $conversationMessage->conversation->uuid,
            ])
            ->assertStatus(302)
            ->assertSessionHasErrors(['message']);

        $this->assertDatabaseCount('conversation_messages', 1);
        $this->assertDatabaseCount('conversations', 1);
    }
}
