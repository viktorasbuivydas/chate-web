<?php

namespace App\Http\Controllers\App;

use App\Actions\UpdateOnline;

class ForumController
{
    public function index()
    {
        app(UpdateOnline::class)->handle('Forume');

        return inertia('App/Forum/Index');
    }
}
