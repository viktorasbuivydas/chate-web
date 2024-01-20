<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
