<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'google_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getUuidName(): string
    {
        return 'uuid';
    }

    public function unreadConversations()
    {
        return $this->hasManyThrough(Conversation::class, ConversationUser::class, 'user_id', 'id', 'id', 'conversation_id');
    }
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function conversations(): HasManyThrough
    {
        return $this->hasManyThrough(ConversationUser::class, ConversationMessage::class, 'user_id', 'conversation_id', 'id', 'id');
    }
}
