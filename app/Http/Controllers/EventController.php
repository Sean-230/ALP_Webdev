<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\EventRegister;
use App\Models\Performer;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['category', 'eventRegisters'])
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->where('approval_status', 'approved');

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

        $events = $query->paginate(9)->withQueryString();
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

        $event = Event::with('user')->findOrFail($eventId);
        
        // Check if user is already registered for this event (pending or paid only)
        $existingRegistration = EventRegister::where('user_id', Auth::id())
            ->where('event_id', $eventId)
            ->whereIn('payment_status', ['pending', 'paid'])
            ->first();
        
        if ($existingRegistration) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You are already registered for this event.'], 400);
            }
            return redirect()->back()->with('error', 'You are already registered for this event.');
        }
        
        // Check if event has available slots (only count pending and paid tickets)
        $registeredCount = EventRegister::where('event_id', $eventId)
            ->whereIn('payment_status', ['pending', 'paid'])
            ->sum('ticket_qty');
        $maxAttends = $event->max_attends ?? $event->capacity ?? 0;
        $requestedQty = $request->ticket_qty;
        
        if ($registeredCount + $requestedQty > $maxAttends) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Not enough available slots for ' . $requestedQty . ' tickets.'], 400);
            }
            return redirect()->back()->with('error', 'Not enough available slots for ' . $requestedQty . ' tickets.');
        }
        
        // Create registration
        $registration = EventRegister::create([
            'user_id' => Auth::id(),
            'event_id' => $eventId,
            'ticket_qty' => $requestedQty,
            'payment_status' => 'pending',
            'created_at' => now(),
        ]);
        
        // Get event manager's phone number
        $eventManager = $event->user;
        if ($eventManager && $eventManager->phone_number) {
            // Clean phone number (remove spaces, dashes, parentheses)
            $phoneNumber = preg_replace('/[^0-9+]/', '', $eventManager->phone_number);
            
            // Prepare WhatsApp message
            $totalPrice = $event->price * $requestedQty;
            $message = "Hi, I would like to register for *{$event->name}*\n\n";
            $message .= "📅 Event Date: " . $event->event_date->format('F d, Y g:i A') . "\n";
            $message .= "🎫 Tickets: {$requestedQty}\n";
            $message .= "💰 Total: Rp " . number_format($totalPrice, 0, ',', '.') . "\n\n";
            $message .= "Please confirm my payment request. Thank you!";
            
            $whatsappUrl = "https://wa.me/{$phoneNumber}?text=" . urlencode($message);
            
            return redirect($whatsappUrl);
        }
        
        return redirect()->back()->with('success', 'Registration submitted! Please contact the event manager for payment confirmation.');
    }

    public function bookings()
    {
        $bookings = EventRegister::with(['event', 'user'])
            ->where('event_registers.user_id', Auth::id())
            ->join('events', 'event_registers.event_id', '=', 'events.id')
            ->orderBy('events.event_date', 'asc')
            ->select('event_registers.*')
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

    /**
     * Show the form for creating a new event (Event Manager only)
     */
    public function create()
    {
        // Check if user is an event manager
        if (Auth::user()->role !== 'eventManager') {
            return redirect()->route('home')->with('error', 'You do not have permission to create events.');
        }

        $categories = Category::all();
        $performers = Performer::all();
        $vendors = Vendor::all();

        return view('event_manager.create-event', compact('categories', 'performers', 'vendors'));
    }

    /**
     * Store a newly created event in storage
     */
    public function store(Request $request)
    {
        // Check if user is an event manager
        if (Auth::user()->role !== 'eventManager') {
            return redirect()->route('home')->with('error', 'You do not have permission to create events.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'event_date' => 'required|date|after:now',
            'venue' => 'required|string|max:255',
            'capacity' => 'required|integer|min:10',
            'event_picture' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'performer_names' => 'nullable|array|max:5',
            'performer_names.*' => 'nullable|string|max:255',
            'performer_genres' => 'nullable|array|max:5',
            'performer_genres.*' => 'nullable|string|max:255',
            'vendors' => 'nullable|array',
            'vendors.*' => 'exists:vendors,id',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('event_picture')) {
            $image = $request->file('event_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/events'), $imageName);
            $imagePath = 'images/events/' . $imageName;
        }

        // Create the event
        $event = Event::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'event_date' => $validated['event_date'],
            'venue' => $validated['venue'],
            'capacity' => $validated['capacity'],
            'max_attends' => $validated['capacity'], // Set max_attends to capacity initially
            'event_picture' => $imagePath,
            'status' => 'upcoming', // All new events are upcoming by default
            'approval_status' => 'pending', // Events need admin approval
        ]);

        // Create performers from manual input
        if (!empty($validated['performer_names'])) {
            foreach ($validated['performer_names'] as $index => $name) {
                if (!empty($name)) {
                    $genre = $validated['performer_genres'][$index] ?? '';
                    
                    // Check if performer already exists
                    $performer = Performer::firstOrCreate(
                        ['name' => $name],
                        ['genre' => $genre]
                    );
                    
                    // Attach to event
                    $event->performers()->attach($performer->id);
                }
            }
        }

        // Attach vendors if selected
        if (!empty($validated['vendors'])) {
            $event->vendors()->attach($validated['vendors']);
        }

        return redirect()->route('events.create')->with('success', 'Event created successfully! Waiting for admin approval.');
    }
}
