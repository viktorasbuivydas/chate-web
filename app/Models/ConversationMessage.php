<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ConversationMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_user_id',
        'message',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $perPage = 20;

    protected $appends = [
        'created_at_hours',
    ];

    protected function createdAtHours(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->diffForHumans(now(), CarbonInterface::DIFF_ABSOLUTE),
        );
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'conversation_user_id');
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }
}
