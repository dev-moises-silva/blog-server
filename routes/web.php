<?php

use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/email/verify', function () {
    return response()->json(['message' => 'Cique no email de verificação de email!'], 403);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(env("CLIENT_URL"));
})->middleware(['auth', 'signed'])->name('verification.verify');
