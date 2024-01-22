<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Conversation extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'uuid',
    ];

    public function getUuidName(): string
    {
        return 'uuid';
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ConversationMessage::class);
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(ConversationMessage::class)->latest();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'conversation_users', 'conversation_id', 'user_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'conversation_users', 'conversation_id', 'user_id');
    }
}
