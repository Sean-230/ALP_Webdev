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
        $featuredEvents = Event::with(['category', 'eventRegisters'])
            ->where('event_date', '>=', now())
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->where('approval_status', 'approved')
            ->orderBy('event_date', 'asc')
            ->limit(6)
            ->get();

        // Get all categories with event count
        $categories = Category::withCount(['events' => function($query) {
            $query->whereIn('status', ['upcoming', 'ongoing'])
                  ->where('approval_status', 'approved');
        }])->get();

        // Get stats
        $totalEvents = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->where('approval_status', 'approved')
            ->count();

        $totalAttendees = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->where('approval_status', 'approved')
            ->sum('capacity');

        return view('user.explore', compact('featuredEvents', 'categories', 'totalEvents', 'totalAttendees'));
    }
}
