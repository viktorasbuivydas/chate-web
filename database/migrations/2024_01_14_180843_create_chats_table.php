<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('mentioned_user_id')->nullable();
            $table->timestamps();
        });
    }
};
