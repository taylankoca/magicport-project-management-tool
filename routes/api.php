<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;


// Public routes
Route::post('/login', [LoginController::class, 'login']);

// Protected routes with Sanctum middleware
Route::middleware('auth:sanctum')->group(function () {

    // Logout route
    Route::post('/logout', [LoginController::class, 'logout']);

    // Authenticated user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Resource routes for projects and tasks (GET, POST, PUT, PATCH)
    Route::apiResource('projects', ProjectController::class)->except(['destroy']);
    Route::apiResource('tasks', TaskController::class)->except(['destroy']);

    // Restrict delete operations to admin users only
    Route::middleware(['role:admin'])->group(function () {
        Route::delete('projects/{project}', [ProjectController::class, 'destroy']);
        Route::delete('tasks/{task}', [TaskController::class, 'destroy']);
    });
});
