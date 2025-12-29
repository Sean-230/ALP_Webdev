<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $pendingApplication = \App\Models\ManagerApplication::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();
        
        $applicationHistory = \App\Models\ManagerApplication::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
        
        return view('user.profile', [
            'user' => $user,
            'pendingApplication' => $pendingApplication,
            'applicationHistory' => $applicationHistory,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        // Only reset email verification if email is actually changed
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    /**
     * Apply for event manager status.
     */
    public function applyForManager(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Check if already an event manager or admin
        if ($user->role === 'eventManager' || $user->role === 'admin') {
            return Redirect::route('profile.edit')->with('error', 'You already have manager or admin privileges.');
        }

        // Check if there's already a pending application
        $existingApplication = \App\Models\ManagerApplication::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingApplication) {
            return Redirect::route('profile.edit')->with('error', 'You already have a pending application.');
        }

        // Create new application
        \App\Models\ManagerApplication::create([
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        return Redirect::route('profile.edit')->with('success', 'Your application has been submitted! An admin will review it shortly.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('profile.edit')->with('success', 'Password updated successfully!');
    }

    /**
     * Dummy email verification (for testing purposes)
     */
    public function verifyEmail(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->hasVerifiedEmail()) {
            return Redirect::route('profile.edit')->with('error', 'Your email is already verified.');
        }
        
        // Mark email as verified without sending actual email
        $user->email_verified_at = now();
        $user->save();
        
        return Redirect::route('profile.edit')->with('success', 'Email verified successfully! You can now register for events.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Your account has been deleted successfully.');
    }
}