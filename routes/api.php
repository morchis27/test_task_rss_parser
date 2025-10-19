<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Posts\DeletePostController;
use App\Http\Controllers\Api\Posts\IndexPostsController;
use App\Http\Controllers\Api\Posts\ShowPostController;
use App\Http\Controllers\Api\Posts\StorePostController;
use App\Http\Controllers\Api\Posts\UpdatePostController;
use Illuminate\Support\Facades\Route;


Route::group([], function () {
    Route::post('/auth/register', RegisterController::class);
    Route::post('/auth/login', LoginController::class);

    Route::post('/auth/logout', LogoutController::class)->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/posts', IndexPostsController::class);
        Route::get('/posts/{id}', ShowPostController::class);
        Route::post('/posts', StorePostController::class);
        Route::put('/posts/{id}', UpdatePostController::class);
        Route::delete('/posts/{id}', DeletePostController::class);
    });
});


