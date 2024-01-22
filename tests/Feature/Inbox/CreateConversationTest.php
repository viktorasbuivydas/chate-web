<?php

namespace Tests\Feature\Inbox;

use App\Models\User;
use Tests\TestCase;

class CreateConversationTest extends TestCase
{
    public function test_user_can_create_conversation()
    {
        $users = User::factory()->count(2)->create();
        $user = $users->first();

        $this->actingAs($user)
            ->post(route('app.conversations.store'), [
                'users' => $users->pluck('id')->toArray(),
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('conversations', 1);
        $this->assertDatabaseCount('conversation_users', 2);
        $this->assertDatabaseHas('conversation_users', [
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('conversation_users', [
            'user_id' => $users[1]->id,
        ]);
    }

    public function test_validation_works_properly()
    {
        $users = User::factory()->count(2)->create();
        $user = $users->first();

        $this->actingAs($user)
            ->post(route('app.conversations.store'), [
                'users' => array_merge($users->pluck('id')->toArray(), [3]),
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();
    }
}
