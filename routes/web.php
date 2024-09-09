<?php

use Illuminate\Support\Facades\Route;

// Dashboard Page (List all projects)
Route::get('/', function () {
    return view('dashboard');
});

// Project Detail Page (Show tasks for a specific project)
Route::get('/projects/{project}', function ($project) {
    return view('project-detail', ['projectId' => $project]);
});
