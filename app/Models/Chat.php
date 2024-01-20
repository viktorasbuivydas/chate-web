<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'user_id',
        'mentioned_user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
