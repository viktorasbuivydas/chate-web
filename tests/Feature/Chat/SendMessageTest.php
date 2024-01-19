<?php

namespace Tests\Feature\Chat;

use App\Models\Chat;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendMessageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_user_can_send_chat_message()
    {
        Event::fake();

        $user = User::factory()->create();
        $message = $this->faker()->sentence();

        $this->actingAs($user)
            ->post(route('app.chat.send-message'), [
                'message' => $message,
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors();

        Event::assertDispatched(MessageSent::class);

        $this->assertDatabaseCount('chats', 1);
        $this->assertDatabaseHas('chats', [
            'user_id' => $user->id,
            'message' => $message
        ]);
    }
}
