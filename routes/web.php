<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::get('/login', function () {
    return view('welcome');
})->name('login');
