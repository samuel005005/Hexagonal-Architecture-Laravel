<?php

use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CreateUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('user')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::get('/notAuthorized', 'notAuthorized')->name('notAuthorized');
    })->prefix('user');
    Route::post('/create', [CreateUserController::class, 'register']);

    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/me', 'me');
    })->middleware('auth:sanctum');
});

