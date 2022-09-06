<?php

use Illuminate\Support\Facades\Route;

Route::prefix("api")->group(function() {

    // auth
    Route::post('/auth/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/auth/register', [\App\Http\Controllers\AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/auth/revoke', [\App\Http\Controllers\AuthController::class, 'revoke']);
        Route::get('/auth/user', [\App\Http\Controllers\AuthController::class, 'user']);

        // flashcards
        Route::post("/flashcards", [\App\Http\Controllers\FlashcardController::class, 'create']);
        Route::put("/flashcards/assign", [\App\Http\Controllers\FlashcardController::class, 'assignToFlashcardFolder']);
        Route::put("/flashcards", [\App\Http\Controllers\FlashcardController::class, 'update']);

        // flashcard folders
        Route::get("/flashcard-folders", [\App\Http\Controllers\FlashcardFolderController::class, 'get']);
        Route::post("/flashcard-folders", [\App\Http\Controllers\FlashcardFolderController::class, 'create']);
    });
});
Route::view('/{uri}', 'app')->where('uri', '^(?!api).*$');
