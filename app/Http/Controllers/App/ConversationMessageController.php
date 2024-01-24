<?php

namespace App\Http\Controllers\App;

use App\Events\InboxMessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationMessageRequest;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\User;

class ConversationMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Conversation $conversation, ConversationMessageRequest $request)
    {
        try {
            $message = $conversation->messages()->create([
                'user_id' => auth()->id(),
                'conversation_id' => $conversation->id,
                'message' => $request->input('message'),
            ]);

            event(new InboxMessageSent($message));
        } catch (\Exception $e) {
            return redirect()->route('app.conversations.index', $conversation->uuid)->with([
                'error' => 'Failed to send message',
            ]);
        }

        return redirect()->route('app.conversations.index', $conversation->uuid);
    }
}
