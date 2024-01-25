<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\ConversationUser;
use App\Models\User;
use App\Queries\ConversationMessageQueries;
use App\Queries\ConversationQueries;

class ConversationController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(ConversationQueries $conversationQueries, ConversationMessageQueries $conversationMessageQueries)
    {
        $userId = auth()->id();
        $conversations = $conversationQueries->getPaginatedConversations($userId);

        abort_if($conversations->isEmpty(), 404);

        $messages = $conversationMessageQueries->getPaginatedConversationMessages($conversations->first(), $userId);

        if (request()->wantsJson()) {
            return response()->json([
                'conversations' => $conversations,
                'messages' => $messages,
            ]);
        }

        return inertia('App/Conversation/Index', [
            'conversations' => $conversations,
            'messages' => $messages,
        ]);
    }

    /**
     * @throws \Exception
     */
    public function show(Conversation $conversation, ConversationQueries $conversationQueries)
    {
        $conversations = app(ConversationQueries::class)
            ->getPaginatedConversations();

        $messages = $conversationQueries->getPaginatedConversationMessages($conversation, $userId);

        // update messages to read
//        $messages->each(function ($message) {
//            if ($message->user_id !== auth()->id()) {
//                $message->update([
//                    'read_at' => now(),
//                ]);
//            }
//        });

        $conversation->load([
            'members' => function ($query) {
                $query->where('user_id', auth()->id());
            },
            'messages.user',
        ]);

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

        return redirect()->route('app.conversations.show', $conversation->uuid);
    }
}
