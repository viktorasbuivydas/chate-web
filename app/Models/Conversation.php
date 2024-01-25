<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Conversation extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
    ];

    protected $perPage = 20;

    public function getUuidName(): string
    {
        return 'uuid';
    }

    public function latestMessage(): HasOneThrough
    {
        return $this->hasOneThrough(ConversationMessage::class, ConversationUser::class, 'conversation_id', 'id', 'id', 'conversation_id')
            ->latest()
            ->limit(1);
    }

    public function latestUnreadMessage(): HasOneThrough
    {
        return $this->latestMessage()
            ->whereNull('read_at');
    }

    public function messages(): HasManyThrough
    {
        return $this->hasManyThrough(ConversationMessage::class, ConversationUser::class, 'conversation_id', 'conversation_user_id', 'id', 'id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'conversation_users', 'conversation_id', 'user_id');
    }

    public function chatWithMembers(): BelongsToMany
    {
        return $this->members()
            ->where('user_id', '!=', auth()->id());
    }
}
