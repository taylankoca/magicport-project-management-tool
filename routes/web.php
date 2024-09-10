<?php

use App\Models\Project;
use App\Events\ProjectUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

// Dashboard Page (List all projects)
Route::get('/', function () {
    return view('dashboard');
});
