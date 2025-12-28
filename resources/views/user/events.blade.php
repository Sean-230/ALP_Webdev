@extends('layouts.app')

@section('title', 'Browse Events - Festivo')

@push('styles')
    <style>
        .events-hero {
            background: linear-gradient(135deg, #360185 0%, #8F0177 50%, #DE1A58 100%);
            padding: 80px 0 60px;
            margin-top: -70px;
            padding-top: 140px;
        }

        .filter-section {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .event-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(54, 1, 133, 0.2);
        }

        .event-card img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .event-card .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
            padding: 1.5rem;
        }

        .event-card .card-title {
            height: 3.6rem;
            line-height: 1.8rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .event-card .venue-text {
            height: 1.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .event-card .description-text {
            height: 3rem;
            line-height: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .event-card .card-footer-actions {
            margin-top: auto;
            padding-top: 1rem;
        }

        .event-date-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #360185, #8F0177);
            color: white;
            padding: 10px 15px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
            box-shadow: 0 4px 10px rgba(54, 1, 133, 0.3);
        }

        .category-badge {
            background: linear-gradient(135deg, #F4B342, #DE1A58);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 25px;
            border: 2px solid #360185;
            color: #360185;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 600;
        }

        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #360185, #8F0177);
            color: white;
            border-color: transparent;
        }

        .search-box {
            border-radius: 25px;
            border: 2px solid #e0e0e0;
            padding: 12px 25px;
            transition: all 0.3s ease;
        }

        .search-box:focus {
            border-color: #360185;
            box-shadow: 0 0 0 3px rgba(54, 1, 133, 0.1);
            outline: none;
        }

        .no-events {
            text-align: center;
            padding: 4rem 2rem;
        }

        .no-events i {
            font-size: 5rem;
            color: #e0e0e0;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="events-hero text-white">
        <div class="container">
            <div class="text-center">
                <h1 class="display-3 fw-bold mb-3">Browse All Events</h1>
                <p class="fs-5 opacity-90">
                    Discover amazing events happening around you. Filter by category to find your perfect experience.
                </p>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-5">
        <div class="container">
            <div class="filter-section">
                <form method="GET" action="{{ route('events') }}" id="filterForm">
                    <div class="row g-4 align-items-end">
                        <!-- Search -->
                        <div class="col-lg-5">
                            <label class="form-label fw-semibold" style="color: #360185;">
                                <i class="bi bi-search me-2"></i>Search Events
                            </label>
                            <input type="text" 
                                   name="search" 
                                   class="form-control search-box" 
                                   placeholder="Search by event name..."
                                   value="{{ request('search') }}">
                        </div>

                        <!-- Category Filter -->
                        <div class="col-lg-4">
                            <label class="form-label fw-semibold" style="color: #360185;">
                                <i class="bi bi-filter me-2"></i>Category
                            </label>
                            <select name="category" class="form-select search-box" onchange="document.getElementById('filterForm').submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sort -->
                        <div class="col-lg-3">
                            <label class="form-label fw-semibold" style="color: #360185;">
                                <i class="bi bi-sort-down me-2"></i>Sort By
                            </label>
                            <select name="sort" class="form-select search-box" onchange="document.getElementById('filterForm').submit()">
                                <option value="upcoming" {{ request('sort') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Added</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Quick Category Filter Buttons -->
                    <div class="mt-4">
                        <label class="form-label fw-semibold d-block mb-3" style="color: #360185;">
                            <i class="bi bi-grid-3x3-gap me-2"></i>Quick Filter
                        </label>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('events') }}" 
                               class="filter-btn {{ !request('category') ? 'active' : '' }}">
                                All Events
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('events', ['category' => $category->id]) }}" 
                                   class="filter-btn {{ request('category') == $category->id ? 'active' : '' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0" style="color: #360185;">
                    <strong>{{ $events->total() }}</strong> Events Found
                    @if(request('category'))
                        in <strong>{{ $categories->find(request('category'))->name }}</strong>
                    @endif
                </h5>
                @if(request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('events') }}" class="btn btn-sm" style="background-color: #F4B342; color: #360185;">
                        <i class="bi bi-x-circle me-2"></i>Clear Filters
                    </a>
                @endif
            </div>

            <!-- Events Grid -->
            @if($events->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach($events as $event)
                        <div class="col-lg-4 col-md-6">
                            <div class="card event-card">
                                <div class="position-relative">
                                    @php
                                        $gradients = [
                                            'linear-gradient(135deg, #360185 0%, #8F0177 100%)',
                                            'linear-gradient(135deg, #8F0177 0%, #DE1A58 100%)',
                                            'linear-gradient(135deg, #DE1A58 0%, #F4B342 100%)',
                                            'linear-gradient(135deg, #F4B342 0%, #360185 100%)',
                                            'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                                        ];
                                        $gradientIndex = $loop->index % count($gradients);
                                    @endphp
                                    <div style="height: 250px; background: {{ $gradients[$gradientIndex] }}; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-calendar-event" style="font-size: 4rem; color: rgba(255, 255, 255, 0.3);"></i>
                                    </div>
                                    <div class="event-date-badge">
                                        <div style="font-size: 1.5rem; line-height: 1;">
                                            {{ $event->event_date->format('d') }}
                                        </div>
                                        <div style="font-size: 0.8rem;">
                                            {{ $event->event_date->format('M Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <span class="category-badge mb-3">
                                        {{ $event->category->name }}
                                    </span>
                                    <h5 class="card-title fw-bold mt-2" style="color: #360185;">
                                        {{ $event->name }}
                                    </h5>
                                    <p class="card-text text-muted venue-text mb-2">
                                        <i class="bi bi-geo-alt-fill me-2"></i>{{ $event->venue }}
                                    </p>
                                    <p class="card-text small description-text mb-3">
                                        {{ $event->description }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center card-footer-actions">
                                        <div class="text-muted small">
                                            <i class="bi bi-people-fill me-1"></i>
                                            Capacity: {{ $event->capacity }}
                                        </div>
                                        <a href="#" class="btn btn-sm fw-semibold"
                                           style="background-color: #360185; color: white; border-radius: 8px;">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $events->links() }}
                </div>
            @else
                <!-- No Events Found -->
                <div class="no-events">
                    <i class="bi bi-calendar-x"></i>
                    <h3 style="color: #360185;">No Events Found</h3>
                    <p class="text-muted">
                        @if(request()->hasAny(['search', 'category']))
                            Try adjusting your filters to find more events.
                        @else
                            There are no events available at the moment. Check back soon!
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'category', 'sort']))
                        <a href="{{ route('events') }}" class="btn btn-lg mt-3" style="background-color: #F4B342; color: #360185;">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>View All Events
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection
