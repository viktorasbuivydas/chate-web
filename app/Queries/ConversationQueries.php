<?php

namespace App\Queries;

use App\Models\Conversation;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ConversationQueries
{
    /**
     * @throws Exception
     */
    public function getConversations(?int $userId = null): Builder
    {
        $userId = $this->checkUserId($userId);

        return Conversation::query()
            ->with([
                'latestMessage.user',
                'chatWithMembers'
            ])
            ->withWhereHas('members', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });
    }

    /**
     * @throws Exception
     */
    public function getPaginatedConversations(?int $userId = null): LengthAwarePaginator
    {
        return $this->getConversations($userId)
            ->paginate();
    }

    /**
     * @throws Exception
     */
    private function checkUserId(?int $userId = null): int
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        if (!$userId) {
            throw new Exception('User id is required');
        }

        return $userId;
    }
}
