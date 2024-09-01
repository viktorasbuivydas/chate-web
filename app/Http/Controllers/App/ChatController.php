<?php

namespace App\Http\Controllers\App;

use App\Models\Chat;
use App\Events\MessageSent;
use App\Actions\UpdateOnline;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Request;

class ChatController
{
    public function index(Request $request)
    {
        app(UpdateOnline::class)->handle('Pokalbiuose');

        $messages = Chat::query()
            ->with('user')
            ->latest()
            ->paginate(10);

        return inertia('App/Chat/Index', [
            'messages' => $messages,
        ]);
    }

    public function sendMessage(ChatRequest $request)
    {
        try {
            $user = auth()->user();
            $chat = $user->chats()->create([
                'message' => $request->message,
            ]);

            $chat->load('user');
            event(new MessageSent($chat));
        } catch (\Exception $e) {
            return redirect()->route('app.chat.index')->with([
                'error' => 'Failed to send message',
            ]);
        }

        return redirect()->route('app.chat.index');
    }
}
