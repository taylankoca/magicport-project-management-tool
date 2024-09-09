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

    // Resource routes for projects and tasks
    Route::apiResource('projects', ProjectController::class);
    Route::apiResource('tasks', TaskController::class);
});
