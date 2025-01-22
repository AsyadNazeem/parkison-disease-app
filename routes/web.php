<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkinsonController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ConsultationDates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Consultant;
use App\Http\Controllers\BookDoctorContoller;
use App\Http\Controllers\DoctorController;

// Make login the landing page
Route::get('/', [LoginController::class, 'index'])->name('index.login');

// Auth routes
Route::get('register', [RegisterController::class, 'index'])->name('index.register');
Route::post('register', [RegisterController::class, 'submit'])->name('submit.register');

Route::get('login', [LoginController::class, 'index'])->name('index.login');
Route::post('login', [LoginController::class, 'submit'])->name('submit.login');

// Authenticated routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    // Patient routes
    Route::get('welcome', function () {
        return view('common.welcome');
    })->name('welcome');

    Route::resource('parkinson', ParkinsonController::class);

    Route::get('patient/patient-dashboard', function () {
        return view('patient.patient-dashboard'); // Doctor dashboard view
    })->name('patient.dashboard');

    Route::get('patient/report', function () {
        return view('patient.report'); // Doctor dashboard view
    })->name('patient.report');

    Route::get('patient/book-doctor', [BookDoctorContoller::class, 'index'])->name('patient.consultation');
    Route::get('patient/book-consultation/{id}', [BookDoctorContoller::class, 'book'])->name('book.consultation');
    Route::Post('patient/book-consultation/{id}', [BookDoctorContoller::class, 'confirm'])->name('confirm.consultation');
    Route::get('patient/my-bookings', [BookDoctorContoller::class, 'viewBookings'])->name('patient.bookings');



    Route::get('patient/profile', function () {
        return view('patient.profile'); // Doctor dashboard view
    })->name('patient.profile');

});

// Doctor routes
Route::middleware(['auth', 'role:doctor', 'doctor.status'])->group(function () {
    Route::get('doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    Route::get('doctor/profile', function () {
        return view('doctor.profile');
    })->name('doctor.profile');

    Route::get('doctor/consultant-form', [Consultant::class, 'index'])->name('index.consultant-form');

    Route::post('doctor/consultant-form', [Consultant::class, 'submit'])->name('submit.consultant-form');

    Route::get('doctor/consultation_dates', [ConsultationDates::class, 'index'])->name('index.consultation-date');

    Route::post('doctor/consultation-dates', [ConsultationDates::class, 'submit'])->name('submit.consultation-dates');

    Route::get('doctor/patient-list', [DoctorController::class, 'index'])->name('index.patients');

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

//Admin
Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'submit'])->name('admin.login.submit');

// Admin-protected routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard view
    })->name('admin.dashboard');
});

Route::post('admin/logout', function () {
    Auth::guard('admin')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('admin.login')->with('status', 'You have been logged out');
})->name('admin.logout');


