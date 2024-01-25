<?php

namespace App\Queries;

use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\ConversationUser;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ConversationMessageQueries
{
    /**
     * @throws Exception
     */
    public function getPaginatedConversationMessages(Conversation $conversation, ?int $userId = null): LengthAwarePaginator
    {
        $conversationUser = ConversationUser::query()
            ->where('conversation_id', $conversation->id)
            ->where('user_id', $userId)
            ->first();

        abort_if(!$conversationUser, 404);

        return ConversationMessage::query()
            ->where('conversation_user_id', $conversationUser->id)
            ->paginate();
    }

    /**
     * @throws Exception
     */
    private function checkUserId(?int $userId = null): int
    {
        if ($userId === null) {
            $userId = auth()->id();
        }

        if ($userId === null) {
            throw new Exception('User id is required');
        }

        return $userId;
    }
}
