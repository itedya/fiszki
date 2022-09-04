<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/revoke', [\App\Http\Controllers\AuthController::class, 'revoke']);
    Route::get('/auth/user', [\App\Http\Controllers\AuthController::class, 'user']);
});

Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register']);
