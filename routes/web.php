<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkinsonController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('parkinson',ParkinsonController::class);
