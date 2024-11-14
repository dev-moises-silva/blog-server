<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum', 'verified']);

Route::controller(UserController::class)->group(function () {
    Route::prefix('/users')->group(function () {
        Route::post('/', 'store');
        Route::get('/', 'index');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::prefix('/posts')->group(function () {
            Route::post('/', 'store');
            Route::get('/', 'index');
            Route::delete('/{post}', 'delete');
        });
    });
});
