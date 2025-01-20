<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkinsonController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('common.welcome');
});

Route::get('/register', [RegisterController::class, 'index']) -> name('index.register');
Route::post('/register', [RegisterController::class, 'submit']) -> name('submit.register');

Route::get('/login', [LoginController::class, 'index']) -> name('index.login');

Route::resource('/parkinson',ParkinsonController::class);
