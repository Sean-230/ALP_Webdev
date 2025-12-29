<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', function () {
    $upcomingEvent = \App\Models\Event::with(['category', 'eventRegisters'])
        ->where('event_date', '>=', now())
        ->where('status', 'upcoming')
        ->orderBy('event_date', 'asc')
        ->first();
    return view('user.home', compact('upcomingEvent'));
})->name('home');

Route::get('/about', function () {
    return view('user.about');
})->name('about');

Route::get('/explore', [\App\Http\Controllers\ExploreController::class, 'index'])->name('explore');

Route::get('/vendors', function () {
    return view('user.vendors');
})->name('vendors');

Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events');
Route::get('/events/{event}', [\App\Http\Controllers\EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [\App\Http\Controllers\EventController::class, 'register'])->middleware(['auth', 'verified'])->name('events.register');

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
    Route::get('/bookings', [EventController::class, 'bookings'])->name('bookings.index');
    Route::get('/bookings/{id}/ticket', [EventController::class, 'viewTicket'])->name('bookings.ticket');
    
    Route::get('/account/change-password', function () {
        return view('user.account.change-password');
    })->name('account.change-password');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/verify-email', [ProfileController::class, 'verifyEmail'])->name('profile.verifyEmail');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('/profile/apply-manager', [ProfileController::class, 'applyForManager'])->name('profile.applyManager');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/payments', [\App\Http\Controllers\AdminController::class, 'payments'])->name('admin.payments');
    
    // Manager Applications
    Route::post('/applications/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveApplication'])->name('admin.applications.approve');
    Route::post('/applications/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectApplication'])->name('admin.applications.reject');
    
    // Event Approvals
    Route::post('/events/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approveEvent'])->name('admin.events.approve');
    Route::post('/events/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectEvent'])->name('admin.events.reject');
    
    // Payment Approvals
    Route::post('/payments/{id}/approve', [\App\Http\Controllers\AdminController::class, 'approvePayment'])->name('admin.payments.approve');
    Route::post('/payments/{id}/reject', [\App\Http\Controllers\AdminController::class, 'rejectPayment'])->name('admin.payments.reject');
    
    // User Management
    Route::post('/users/{id}/revoke-manager', [\App\Http\Controllers\AdminController::class, 'revokeEventManager'])->name('admin.users.revoke-manager');
});

require __DIR__.'/auth.php';