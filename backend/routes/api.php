<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\UsersController;

Route::get('/', [ApiController::class, 'index']);

// -- Public Users
// Authorization
Route::post('/users/login',                                         [UsersController::class, 'login']);

// Registration config (data for registration form)
Route::get('/users/register-config',                                [UsersController::class, 'registrationConfig']);
// Registration submission (multi-step)
Route::post('/users/register',                                      [UsersController::class, 'register']);

// Reset Password config (data for reset password form)
Route::get('/users/reset-password-config',                         [UsersController::class, 'resetPasswordConfig']);
Route::post('/users/reset-password-email',                         [UsersController::class, 'resetPasswordEmail']);
Route::post('/users/reset-password',                               [UsersController::class, 'resetPasswordProcess']);

// Authenticated
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users/logout',                                    [UsersController::class, 'logout']);

    // Route::get('/user',                                             [UsersController::class, 'user']);

});

// Catch all route
Route::any('/users/{catchall}',                                     [ApiController::class, 'invalidRequest'])->where('catchall', '.*');
Route::any('/{catchall}',                                           [ApiController::class, 'invalidRequest'])->where('catchall', '.*');
