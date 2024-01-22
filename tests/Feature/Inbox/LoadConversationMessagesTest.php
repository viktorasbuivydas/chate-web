<?php

namespace Tests\Feature\Inbox;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use Tests\TestCase;

class LoadConversationMessagesTest extends TestCase
{
    public function test_user_can_get_all_messages()
    {
        $conversations = Conversation::factory()->count(10)->create();
        $conversationMessages = ConversationMessage::factory()
            ->recycle($conversations)
            ->count(10)
            ->create();

        $conversationMessages->load('user');

        $this->actingAs($conversationMessages[0]->user)
            ->get(route('app.conversations.index'))
            ->assertStatus(200);
    }
}
