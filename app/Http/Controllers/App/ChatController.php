<?php

namespace App\Http\Controllers\App;

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
            $user->chats()->create([
                'message' => $request->message,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('app.chat.index')->with([
                'error' => 'Failed to send message',
            ]);
        }
        return redirect()->route('app.chat.index');
    }
}
