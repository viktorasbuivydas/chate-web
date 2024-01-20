<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
      'uuid'
    ];

    public function getUuidName()
    {
        return 'uuid';
    }

    public function messages()
    {
        return $this->hasMany(ConversationMessage::class);
    }
}
