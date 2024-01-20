<?php

namespace App\Http\Controllers\App;

use App\Events\InboxMessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationMessageRequest;
use App\Models\Conversation;
use App\Models\ConversationMessage;

class ConversationMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Conversation $conversation, ConversationMessageRequest $request)
    {
        try {
            $message = $conversation->messages()->create([
                'sender_id' => auth()->id(),
                'receiver_id' => $request->input('receiver_id'),
                'message' => $request->input('message'),
            ]);

            event(new InboxMessageSent($message));
        } catch (\Exception $e) {
            return redirect()->route('app.inbox.show', $conversation->uuid)->with([
                'error' => 'Failed to send message',
            ]);
        }

        return redirect()->route('app.inbox.show', $conversation->uuid);
    }

    /**
     * Display the specified resource.
     */
    public function show(ConversationMessage $conversationMessage)
    {
        // show message
    }
}
