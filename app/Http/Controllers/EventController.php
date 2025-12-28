<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
