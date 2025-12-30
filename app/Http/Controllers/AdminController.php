<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\EventRegister;
use App\Models\ManagerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard(): View
    {
        $pendingApplications = ManagerApplication::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingEvents = Event::with(['category'])
            ->where('approval_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'event_managers' => User::where('role', 'eventManager')->count(),
            'vendor_managers' => User::where('role', 'vendorManager')->count(),
            'admins' => User::where('role', 'admin')->count(),
            'pending_applications' => $pendingApplications->count(),
            'pending_events' => $pendingEvents->count(),
            'pending_payments' => EventRegister::where('payment_status', 'pending')->count(),
            'total_events' => Event::count(),
        ];

        return view('admin.dashboard', compact('pendingApplications', 'pendingEvents', 'stats'));
    }

    /**
     * Show all users
     */
    public function users(): View
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.users', compact('users'));
    }

    /**
     * Approve manager application
     */
    public function approveApplication($id): RedirectResponse
    {
        $application = ManagerApplication::with('user')->findOrFail($id);

        $application->update([
            'status' => 'approved',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now()
        ]);

        // Assign role based on application type - handle both underscore and non-underscore versions
        if ($application->role_type === 'eventManager' || $application->role_type === 'event_manager') {
            $role = 'eventManager';
            $roleLabel = 'Event Manager';
        } else {
            $role = 'vendorManager';
            $roleLabel = 'Vendor Manager';
        }
        
        $application->user->update(['role' => $role]);

        return redirect()->back()->with('success', "Application approved! User is now a {$roleLabel}.");
    }

    /**
     * Reject manager application
     */
    public function rejectApplication(Request $request, $id): RedirectResponse
    {
        $application = ManagerApplication::findOrFail($id);

        $application->update([
            'status' => 'rejected',
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
            'rejection_reason' => $request->input('reason', 'Application did not meet requirements.')
        ]);

        return redirect()->back()->with('success', 'Application rejected.');
    }

    /**
     * Approve event
     */
    public function approveEvent($id): RedirectResponse
    {
        $event = Event::findOrFail($id);

        $event->update([
            'approval_status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        return redirect()->back()->with('success', 'Event approved successfully!');
    }

    /**
     * Reject event
     */
    public function rejectEvent(Request $request, $id): RedirectResponse
    {
        $event = Event::findOrFail($id);

        $event->update([
            'approval_status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now()
        ]);

        return redirect()->back()->with('success', 'Event rejected.');
    }

    /**
     * Revoke manager role from user
     */
    public function revokeEventManager($id): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Prevent revoking admin role
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Cannot revoke admin role.');
        }

        // Check if user is a manager
        if (!in_array($user->role, ['eventManager', 'vendorManager'])) {
            return redirect()->back()->with('error', 'User is not a manager.');
        }

        $roleLabel = $user->role === 'eventManager' ? 'Event Manager' : 'Vendor Manager';
        $user->update(['role' => 'user']);

        return redirect()->back()->with('success', "{$roleLabel} role revoked successfully! User is now a regular user.");
    }

    /**
     * Show all pending payments
     */
    public function payments(): View
    {
        $pendingPayments = EventRegister::with(['user', 'event'])
            ->where('payment_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'pending' => EventRegister::where('payment_status', 'pending')->count(),
            'paid' => EventRegister::where('payment_status', 'paid')->count(),
            'total' => EventRegister::count(),
        ];

        return view('admin.payments', compact('pendingPayments', 'stats'));
    }

    /**
     * Approve payment
     */
    public function approvePayment($id): RedirectResponse
    {
        $payment = EventRegister::findOrFail($id);

        $payment->update([
            'payment_status' => 'paid',
        ]);

        return redirect()->back()->with('success', 'Payment approved successfully!');
    }

    /**
     * Reject payment
     */
    public function rejectPayment($id): RedirectResponse
    {
        $payment = EventRegister::findOrFail($id);

        // Delete the registration
        $payment->delete();

        return redirect()->back()->with('success', 'Payment rejected and registration removed.');
    }
}
