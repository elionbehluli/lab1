<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Models\User;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/refreshToken', [UserController::class, 'refreshToken']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/password/forgot', [UserController::class, 'forgotPassword']);
    Route::post('/password/reset', [UserController::class, 'resetPassword'])->name('password.reset');
});