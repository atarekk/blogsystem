<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
Route::post("login",[LoginController::class,"login"])->name('api.login');
    Route::middleware('auth:sanctum')->group(function () {
              Route::apiResource('posts', PostController::class)->only(['index']);
        Route::post('posts/show', [PostController::class, 'showPost'])->name('api.posts.show');

    });
});
