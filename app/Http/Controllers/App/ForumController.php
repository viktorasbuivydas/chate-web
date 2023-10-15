<?php

namespace App\Http\Controllers\App;

class ForumController {
    public function index() {
        return inertia('App/Forum/Index');
    }
}
