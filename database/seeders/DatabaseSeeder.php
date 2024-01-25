<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $users = User::factory(10)->create();

        $conversations = Conversation::factory(10)->create();
        ConversationMessage::factory(100)
            ->recycle($conversations)
            ->recycle($users)
            ->create();
    }
}
