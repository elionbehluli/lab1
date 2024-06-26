<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CarController;
use App\Http\Middleware\AdminCheck;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceHistoriesController;
use App\Http\Controllers\CarPartController;


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

Route::get('/services', [ServiceController::class, 'index']);
Route::post('/services', [ServiceController::class, 'store']);
Route::get('/services/{id}', [ServiceController::class, 'show']);
Route::put('services/{id}', [ServiceController::class, 'update']);
Route::delete('services/{id}', [ServiceController::class, 'destroy']);

Route::get('/service-histories', [ServiceHistoriesController::class, 'index']);
Route::get('/service-histories/{id}/car', [ServiceHistoriesController::class, 'specificCarSerciveHistory']);
Route::post('/service-histories', [ServiceHistoriesController::class, 'store']);
Route::get('/service-histories/{id}', [ServiceHistoriesController::class, 'show']);
Route::delete('services-histories/{id}', [ServiceHistoriesController::class, 'destroy']);

Route::get('/car_parts', [CarPartController::class, 'index']);
Route::get('/car_parts/{id}/car', [CarPartController::class, 'specificCarParts']);
Route::post('/car_parts', [CarPartController::class, 'store']);
Route::get('/car_parts/{id}', [CarPartController::class, 'show']);
Route::put('car_parts/{id}', [CarPartController::class, 'update']);
Route::delete('car_parts/{id}', [CarPartController::class, 'destroy']);
Route::put('/car_parts/{id}/add', [CarPartController::class, 'addCarPartsToCar']);


Route::middleware(AdminCheck::class)->group(function () {
    Route::post('/cars', [CarController::class, 'store']);
    Route::post('/cars/{id}/images', [CarController::class, 'storeCarImages']);
    Route::delete('/car-images', [CarController::class, 'deleteCarImages']);
    Route::put('cars/{id}', [CarController::class, 'update']);
    Route::delete('cars/{id}', [CarController::class, 'destroy']);
    
    Route::get('/users', [ManageUsersController::class, 'index']);
    Route::put('/users/{id}/edit-role', [ManageUsersController::class, 'editRole']);
    Route::delete('users/{id}', [ManageUsersController::class, 'destroy']);

    Route::post('/brands', [BrandController::class, 'store']);
    Route::delete('brands/{id}', [BrandController::class, 'destroy']);
    Route::post('brands/{id}', [BrandController::class, 'update']);
});

