<?php

use App\Http\Controllers\PatientDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParkinsonController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// Make login the landing page
Route::get('/', [LoginController::class, 'index'])->name('index.login');

// Auth routes
Route::get('register', [RegisterController::class, 'index'])->name('index.register');
Route::post('register', [RegisterController::class, 'submit'])->name('submit.register');

Route::get('login', [LoginController::class, 'index'])->name('index.login');
Route::post('login', [LoginController::class, 'submit'])->name('submit.login');

// Welcome page moved to authenticated area
Route::middleware(['auth'])->group(function () {
    Route::get('welcome', function () {
        return view('common.welcome');
    })->name('welcome');

    Route::get('patient-dashboard', [PatientDashboardController::class, 'index'])
        ->name('PDashboard.index');

    Route::resource('parkinson', ParkinsonController::class);
});


Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    $response = redirect('/')->with('status', 'You have been logged out');

    $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
    $response->headers->set('Pragma', 'no-cache');
    $response->headers->set('Expires', '0');

    return $response;
})->name('logout');
