<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Online extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'browser',
        'os',
        'last_place',
        'updated_at',
    ];
}
