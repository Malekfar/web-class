<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:web', 'prefix' => 'panel'], function () {
    Route::resource('users', UserController::class);
    Route::view('/', 'index')->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::view('/login', 'login')->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');


Route::get('test', function () {
    dd("s");
});