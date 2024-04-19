<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CarController;
use App\Http\Middleware\AdminCheck;
use App\Http\Controllers\BrandController;

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

Route::get('/brands', [BrandController::class, 'index']);
Route::get('/brands/{id}', [BrandController::class, 'show']);


Route::middleware(AdminCheck::class)->group(function () {
    Route::post('/cars', [CarController::class, 'store']);
    Route::post('/cars/{id}/images', [CarController::class, 'storeCarImages']);
    Route::put('cars/{id}', [CarController::class, 'update']);
    Route::delete('cars/{id}', [CarController::class, 'destroy']);

    Route::post('/brands', [BrandController::class, 'store']);
    Route::delete('brands/{id}', [BrandController::class, 'destroy']);
    Route::post('brands/{id}', [BrandController::class, 'update']);
});

