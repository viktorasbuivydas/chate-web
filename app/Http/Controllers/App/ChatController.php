<?php

namespace App\Http\Controllers\App;

class ChatController
{
    public function index()
    {
        return inertia('App/Chat/Index');
    }
}
