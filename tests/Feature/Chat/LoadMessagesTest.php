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

class LoadMessagesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_user_can_get_chat_messages()
    {
        $users = User::factory()->count(5)->create();
        $messages = Chat::factory()
            ->recycle($users)
            ->count(50)->create();

        $this->actingAs($messages->first()->user)
            ->get(route('app.chat.index'))
            ->assertStatus(200)
            ->assertInertia(fn(Assert $page) => $page
                ->component('App/Chat/Index')
                // Checking a root-level property...
                ->has('messages')
            );
    }
}
