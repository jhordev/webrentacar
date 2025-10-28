<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::prefix('v1')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{id}', [PostController::class, 'show']);
});
