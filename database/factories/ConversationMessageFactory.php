<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conversation_user_id' => ConversationUser::factory(),
            'message' => $this->faker->sentence(),
            'read_at' => $this->randomReadAtState(),
        ];
    }

    private function randomReadAtState(): ?\DateTime
    {
        return $this->faker->boolean(50) ? $this->faker->dateTime() : null;
    }
}
