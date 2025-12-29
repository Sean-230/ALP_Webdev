<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        // Get featured events (sorted by earliest date first)
        $featuredEvents = Event::with('category')
            ->withCount('eventRegisters')
            ->where('event_date', '>=', now())
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('event_date', 'asc')
            ->limit(6)
            ->get();

        // Get all categories with event count
        $categories = Category::withCount(['events' => function($query) {
            $query->whereIn('status', ['upcoming', 'ongoing']);
        }])->get();

        // Get stats
        $totalEvents = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->count();

        $totalAttendees = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->sum('capacity');

        return view('user.explore', compact('featuredEvents', 'categories', 'totalEvents', 'totalAttendees'));
    }
}
