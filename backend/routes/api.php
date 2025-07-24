<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\UsersController;

Route::get('/', [ApiController::class, 'index']);

// -- Public Users
// Login
Route::post('/login', [UsersController::class, 'login']);
// Registration config (data for registration form)
Route::get('/registration-config', [UsersController::class, 'registrationConfig']);
// Registration submission (multi-step)
Route::post('/users/register', [UsersController::class, 'register']);

// Authenticated
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UsersController::class, 'logout']);

    
    Route::get('/user', [UsersController::class, 'user']);

});
