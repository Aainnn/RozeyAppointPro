<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes (from Breeze)
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer routes
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
        
        // Booking flow routes
        Route::prefix('booking')->name('booking.')->group(function () {
            Route::get('/step1', [BookingController::class, 'step1'])->name('step1');
            Route::post('/step1', [BookingController::class, 'storeStep1'])->name('storeStep1');
            Route::get('/step2', [BookingController::class, 'step2'])->name('step2');
            Route::post('/step2', [BookingController::class, 'storeStep2'])->name('storeStep2');
            Route::get('/step3', [BookingController::class, 'step3'])->name('step3');
            Route::post('/step3', [BookingController::class, 'storeStep3'])->name('storeStep3');
            Route::get('/step4', [BookingController::class, 'step4'])->name('step4');
            Route::post('/submit', [BookingController::class, 'store'])->name('submit');
        });
        
        // Booking management routes
        Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    // Staff routes
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [StaffController::class, 'dashboard'])->name('dashboard');
        Route::get('/manage', [StaffController::class, 'manage'])->name('manage');
        Route::patch('/bookings/{booking}/status', [StaffController::class, 'updateStatus'])->name('bookings.updateStatus');
    });
});
