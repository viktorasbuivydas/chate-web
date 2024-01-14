<?php

namespace App\Http\Controllers\App;

use App\Events\MessageSent;
use App\Http\Requests\ChatRequest;

class ChatController
{
    public function index()
    {
        return inertia('App/Chat/Index');
    }

    public function sendMessage(ChatRequest $request)
    {
        try {
            $user = auth()->user();
            $chat = $user->chats()->create([
                'message' => $request->message,
            ]);

            event(new MessageSent($chat));
        } catch (\Exception $e) {
            return redirect()->route('app.chat.index')->with([
                'error' => 'Failed to send message',
            ]);
        }
        return redirect()->route('app.chat.index');
    }
}
