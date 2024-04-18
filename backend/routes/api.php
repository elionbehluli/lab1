<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CarController;
use App\Http\Middleware\AdminCheck;

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

Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/{id}', [CarController::class, 'show']);
Route::post('/cars', [CarController::class, 'store'])->middleware(AdminCheck::class);
Route::post('/cars/{id}/images', [CarController::class, 'storeCarImages'])->middleware(AdminCheck::class);
Route::put('cars/{id}', [CarController::class, 'update'])->middleware(AdminCheck::class);
Route::delete('cars/{id}', [CarController::class, 'destroy'])->middleware(AdminCheck::class);