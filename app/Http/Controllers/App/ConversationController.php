<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;

class ConversationController extends Controller
{
    public function index(?Conversation $conversation = null)
    {
        $conversations = Conversation::with([
            'latestMessage.user',
            'chatWithMembers'
        ])
            ->withWhereHas('members', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->paginate(20);

        if ($conversation) {
            $conversation->load([
                'members' => function ($query) {
                    $query->where('user_id', auth()->id());
                },
                'messages.user',
            ]);
        }

        $messages = ConversationMessage::with('user')
            ->where('conversation_id', $conversation?->id)
//            ->latest()
            ->paginate(20);

        // update messages to read
        $messages->each(function ($message) {
            if ($message->user_id !== auth()->id()) {
                $message->update([
                    'read_at' => now(),
                ]);
            }
        });

        if (!$conversation) {
            $conversation = $conversations->first();
        }

        if (request()->wantsJson()) {
            return response()->json([
                'conversations' => $conversations,
            ]);
        }

        return inertia('App/Conversation/Index', [
            'conversations' => $conversations,
            'conversation' => $conversation,
            'messages' => $messages,
        ]);
    }

    public function store(ConversationRequest $request)
    {
        $conversation = Conversation::create();

        $conversation->users()->attach($request->input('users'));

        return redirect()->route('app.conversations.index', $conversation->uuid);
    }
}
