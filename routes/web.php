<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    return view('user.home');
})->name('home');

Route::get('/vendors', function () {
    return view('user.vendors');
})->name('vendors');

Route::get('/events', function () {
    return view('user.events');
})->name('events');

Route::get('/contact', function () {
    return view('user.contact');
})->name('contact');
// Dashboard - redirect based on user role
Route::get('/dashboard', function () {
    if (Auth::user()?->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', function () {
        return view('user.bookings.index');
    })->name('bookings.index');
    
    Route::get('/account/change-password', function () {
        return view('user.account.change-password');
    })->name('account.change-password');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/vendors', function () {
        return view('admin.vendors');
    })->name('admin.vendors');
    
    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');
});

require __DIR__.'/auth.php';
