<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;

class ConversationController extends Controller
{
    public function index()
    {
        $user = User::with('conversations')
            ->find(auth()->id());

        $conversations = Conversation::with([
            'latestMessage',
            'latestMessage.user',
            'members' => function ($query) {
                $query->where('user_id', '!=', auth()->id());
            }])
            ->whereHas('members', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->paginate(20);

        $messages = ConversationMessage::with('user')
            ->where('conversation_id', $user->conversations->first()->id)
            ->latest()
            ->paginate(20);

        return inertia('App/Conversation/Index', [
            'conversations' => $conversations,
            'messages' => $messages,
        ]);
    }

    public function store(ConversationRequest $request)
    {
        $conversation = Conversation::create();

        $conversation->users()->attach($request->input('users'));

        return redirect()->route('app.conversations.show', $conversation->uuid);
    }
}
