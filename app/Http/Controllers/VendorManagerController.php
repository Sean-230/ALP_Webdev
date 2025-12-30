<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class VendorManagerController extends Controller
{
    /**
     * Show vendor profile setup/edit page
     */
    public function profile()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        
        return view('vendor_manager.profile', compact('vendor'));
    }

    /**
     * Store or update vendor profile
     */
    public function storeProfile(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $vendor = Vendor::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]
        );

        return redirect()->route('vendor.profile')->with('success', 'Vendor profile saved successfully! You can now apply to events.');
    }

    /**
     * Show available events to apply
     */
    public function events()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        
        if (!$vendor) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your vendor profile first before applying to events.');
        }

        // Get events that are upcoming or ongoing and approved
        $events = Event::with(['category', 'vendors'])
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->where('approval_status', 'approved')
            ->orderBy('event_date', 'asc')
            ->get();

        // Check which events the vendor has already applied to
        $appliedEventIds = $vendor->events()->pluck('events.id')->toArray();

        return view('vendor_manager.events', compact('vendor', 'events', 'appliedEventIds'));
    }

    /**
     * Apply to an event
     */
    public function applyToEvent(Request $request, $eventId): RedirectResponse
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        
        if (!$vendor) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your vendor profile first.');
        }

        $event = Event::findOrFail($eventId);

        // Check if already applied
        if ($vendor->events()->where('event_id', $eventId)->exists()) {
            return redirect()->back()->with('error', 'You have already applied to this event.');
        }

        // Attach vendor to event
        $vendor->events()->attach($eventId);

        return redirect()->back()->with('success', 'Successfully applied to ' . $event->name . '!');
    }

    /**
     * Show my applications
     */
    public function myApplications()
    {
        $vendor = Vendor::where('user_id', Auth::id())->first();
        
        if (!$vendor) {
            return redirect()->route('vendor.profile')->with('error', 'Please complete your vendor profile first.');
        }

        $appliedEvents = $vendor->events()->with('category')->orderBy('event_date', 'desc')->get();

        return view('vendor_manager.applications', compact('vendor', 'appliedEvents'));
    }
}
