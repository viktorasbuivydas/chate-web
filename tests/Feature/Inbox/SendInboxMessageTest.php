<?php

namespace Tests\Feature\Inbox;

use App\Models\Conversation;
use Tests\TestCase;

class SendInboxMessageTest extends TestCase
{
    public function test_user_can_send_inbox_message()
    {
        $conversation = Conversation::factory()->create();

        $conversation->load('sender');

        $this->actingAs($conversation->sender)
            ->post(route('app.inbox.send-message', $conversation->uuid), [
                'receiver_id' => $conversation->receiver->id,
                'message' => 'Hello, World!',
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
    }
}
