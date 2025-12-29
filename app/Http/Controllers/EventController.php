<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\EventRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category')
            ->whereIn('status', ['upcoming', 'ongoing']);

        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Search by name if provided
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort by date
        $sortBy = $request->get('sort', 'upcoming');
        if ($sortBy === 'upcoming') {
            $query->where('event_date', '>=', now())->orderBy('event_date', 'asc');
        } elseif ($sortBy === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'name') {
            $query->orderBy('name', 'asc');
        }

        $events = $query->paginate(12);
        $categories = Category::all();

        return view('user.events', compact('events', 'categories'));
    }

    public function show($id)
    {
        $event = Event::with(['category', 'performers', 'vendors', 'registrations'])
            ->findOrFail($id);
        
        return view('user.event-detail', compact('event'));
    }

    public function register(Request $request, $eventId)
    {
        $request->validate([
            'ticket_qty' => 'required|integer|min:1|max:10',
        ]);

        $event = Event::findOrFail($eventId);
        
        // Check if user is already registered for this event
        $existingRegistration = EventRegister::where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->first();
        
        if ($existingRegistration) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You are already registered for this event.'], 400);
            }
            return redirect()->back()->with('error', 'You are already registered for this event.');
        }
        
        // Check if event has available slots
        $registeredCount = EventRegister::where('event_id', $eventId)->sum('ticket_qty');
        $maxAttends = $event->max_attends ?? $event->capacity ?? 0;
        $requestedQty = $request->ticket_qty;
        
        if ($registeredCount + $requestedQty > $maxAttends) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Not enough available slots for ' . $requestedQty . ' tickets.'], 400);
            }
            return redirect()->back()->with('error', 'Not enough available slots for ' . $requestedQty . ' tickets.');
        }
        
        // Create registration
        EventRegister::create([
            'user_id' => Auth::id(),
            'event_id' => $eventId,
            'ticket_qty' => $requestedQty,
            'payment_status' => 'pending',
            'created_at' => now(),
        ]);
        
        return redirect()->back()->with('success', 'Payment request submitted! Please wait for admin approval.');
    }

    public function bookings()
    {
        $bookings = EventRegister::with(['event', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('user.bookings.index', compact('bookings'));
    }

    public function viewTicket($id)
    {
        $booking = EventRegister::with(['event', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return view('user.bookings.ticket', compact('booking'));
    }
}
