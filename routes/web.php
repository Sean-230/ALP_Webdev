<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    return view('user.home');
})->name('home');

Route::get('/about', function () {
    return view('user.about');
})->name('about');

Route::get('/explore', [\App\Http\Controllers\ExploreController::class, 'index'])->name('explore');

Route::get('/vendors', function () {
    return view('user.vendors');
})->name('vendors');

Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events');

Route::get('/faq', function () {
    return view('user.faq');
})->name('faq');

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
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/apply-manager', [ProfileController::class, 'applyForManager'])->name('profile.applyManager');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    
    // Manager Applications
    Route::post('/applications/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveApplication'])->name('admin.applications.approve');
    Route::post('/applications/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectApplication'])->name('admin.applications.reject');
    
    // Event Approvals
    Route::post('/events/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveEvent'])->name('admin.events.approve');
    Route::post('/events/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectEvent'])->name('admin.events.reject');
    
    // User Management
    Route::post('/users/{id}/revoke-manager', [\App\Http\Controllers\AdminController::class, 'revokeEventManager'])->name('admin.users.revoke-manager');
});

require __DIR__.'/auth.php';