<?php

use Illuminate\Support\Facades\Route;

Route::prefix("api")->group(function() {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/auth/revoke', [\App\Http\Controllers\AuthController::class, 'revoke']);
        Route::get('/auth/user', [\App\Http\Controllers\AuthController::class, 'user']);
    });

    Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register']);
});
Route::view('/{uri}', 'app')->where('uri', '^(?!api).*$');
