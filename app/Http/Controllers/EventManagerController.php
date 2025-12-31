<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Performer;
use App\Models\Vendor;
use App\Models\EventPerformer;
use App\Models\EventVendor;
use App\Models\EventRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventManagerController extends Controller
{
    /**
     * Show all events created by the event manager with payments tab
     */
    public function manageEvents()
    {
        $events = Event::with(['category', 'performers', 'vendors', 'eventRegisters'])
            ->where('user_id', Auth::id())
            ->orderBy('event_date', 'desc')
            ->get();

        // Get all events created by this event manager
        $eventIds = Event::where('user_id', Auth::id())->pluck('id');

        // Get pending payments for these events
        $pendingPayments = EventRegister::with(['user', 'event'])
            ->whereIn('event_id', $eventIds)
            ->where('payment_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $paymentStats = [
            'pending' => EventRegister::whereIn('event_id', $eventIds)->where('payment_status', 'pending')->count(),
            'paid' => EventRegister::whereIn('event_id', $eventIds)->where('payment_status', 'paid')->count(),
            'total' => EventRegister::whereIn('event_id', $eventIds)->count(),
        ];

        return view('event_manager.manage-events', compact('events', 'pendingPayments', 'paymentStats'));
    }

    /**
     * Show all events created by the event manager
     */
    public function myEvents()
    {
        return redirect()->route('event-manager.manage');
    }

    /**
     * Show the form for editing an event
     */
    public function edit($id)
    {
        $event = Event::with(['performers', 'vendors'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $categories = Category::all();
        $performers = Performer::all();
        $vendors = Vendor::all();

        // Get current performer and vendor IDs
        $selectedPerformers = $event->performers->pluck('id')->toArray();
        $selectedVendors = $event->vendors->pluck('id')->toArray();

        return view('event_manager.edit-event', compact('event', 'categories', 'performers', 'vendors', 'selectedPerformers', 'selectedVendors'));
    }

    /**
     * Update the event
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $event = Event::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'event_date' => 'required|date|after:now',
            'venue' => 'required|string|max:255',
            'max_attends' => 'required|integer|min:10',
            'event_picture' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'performers' => 'nullable|array|max:5',
            'performers.*.name' => 'nullable|string|max:255',
            'performers.*.genre' => 'nullable|string|max:255',
            'vendors' => 'nullable|array',
            'vendors.*' => 'exists:vendors,id',
        ]);

        // Handle image upload
        if ($request->hasFile('event_picture')) {
            $image = $request->file('event_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/events'), $imageName);
            $validated['event_picture'] = 'images/events/' . $imageName;

            // Delete old image if exists
            if ($event->event_picture && file_exists(public_path($event->event_picture))) {
                unlink(public_path($event->event_picture));
            }
        }

        // Update the event
        $event->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'event_date' => $validated['event_date'],
            'venue' => $validated['venue'],
            'max_attends' => $validated['max_attends'],
            'event_picture' => $validated['event_picture'] ?? $event->event_picture,
        ]);

        // Update performers - detach all and re-attach
        $event->eventPerformers()->delete();
        if (!empty($request->performers)) {
            foreach ($request->performers as $performerData) {
                if (!empty($performerData['name'])) {
                    $performer = Performer::firstOrCreate(
                        ['name' => $performerData['name']],
                        ['genre' => $performerData['genre'] ?? '']
                    );
                    
                    EventPerformer::create([
                        'event_id' => $event->id,
                        'performer_id' => $performer->id,
                    ]);
                }
            }
        }

        // Update vendors
        EventVendor::where('event_id', $event->id)->delete();
        if (!empty($validated['vendors'])) {
            foreach ($validated['vendors'] as $vendorId) {
                EventVendor::create([
                    'event_id' => $event->id,
                    'vendor_id' => $vendorId,
                ]);
            }
        }

        return redirect()->route('event-manager.my-events')->with('success', 'Event updated successfully!');
    }

    /**
     * Show all payment requests for event manager's events
     */
    public function payments(): RedirectResponse
    {
        return redirect()->route('event-manager.manage', ['#payment-requests']);
    }

    /**
     * Approve payment for event manager's event
     */
    public function approvePayment($id): RedirectResponse
    {
        $payment = EventRegister::with('event')->findOrFail($id);

        // Verify that this payment belongs to an event owned by this event manager
        if ($payment->event->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $payment->update([
            'payment_status' => 'paid',
        ]);

        return redirect()->route('event-manager.manage', ['#payment-requests'])->with('success', 'Payment approved successfully!');
    }

    /**
     * Reject payment for event manager's event
     */
    public function rejectPayment($id): RedirectResponse
    {
        $payment = EventRegister::with('event')->findOrFail($id);

        // Verify that this payment belongs to an event owned by this event manager
        if ($payment->event->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Delete the registration
        $payment->delete();

        return redirect()->route('event-manager.manage', ['#payment-requests'])->with('success', 'Payment rejected and registration removed.');
    }
}
