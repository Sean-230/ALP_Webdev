<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        // Get featured events (latest 6 upcoming events)
        $featuredEvents = Event::with('category')
            ->where('event_date', '>=', now())
            ->whereIn('status', ['upcoming', 'ongoing'])
            ->orderBy('created_at', 'desc')
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
