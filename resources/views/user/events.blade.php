@extends('layouts.app')

@section('title', 'Browse Events - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
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
                            <label class="form-label">
                                <i class="bi bi-search"></i>
                                <span>Search Events</span>
                            </label>
                            <div class="position-relative">
                                <input type="text" name="search" class="form-control search-box ps-5"
                                    placeholder="Search by event name..." value="{{ request('search') }}">
                                <i class="bi bi-search position-absolute"
                                    style="left: 14px; top: 50%; transform: translateY(-50%); color: #a0a0a0; font-size: 0.9rem;"></i>
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="col-lg-4">
                            <label class="form-label">
                                <i class="bi bi-funnel-fill"></i>
                                <span>Category</span>
                            </label>
                            <div class="position-relative">
                                <select name="category" class="form-select search-box ps-5"
                                    onchange="document.getElementById('filterForm').submit()">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="bi bi-funnel-fill position-absolute"
                                    style="left: 14px; top: 50%; transform: translateY(-50%); color: #a0a0a0; pointer-events: none; font-size: 0.9rem;"></i>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="col-lg-3">
                            <label class="form-label">
                                <i class="bi bi-sort-down-alt"></i>
                                <span>Sort By</span>
                            </label>
                            <div class="position-relative">
                                <select name="sort" class="form-select search-box ps-5"
                                    onchange="document.getElementById('filterForm').submit()">
                                    <option value="upcoming" {{ request('sort') == 'upcoming' ? 'selected' : '' }}>Upcoming
                                    </option>
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Added
                                    </option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)
                                    </option>
                                </select>
                                <i class="bi bi-sort-down-alt position-absolute"
                                    style="left: 14px; top: 50%; transform: translateY(-50%); color: #a0a0a0; pointer-events: none; font-size: 0.9rem;"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Results Count -->
            <div class="d-flex justify-content-between align-items-center mb-4 p-2 rounded-3"
                style="background: linear-gradient(135deg, rgba(54, 1, 133, 0.05), rgba(244, 179, 66, 0.05)); border-left: 4px solid #360185;">
                <h6 class="mb-0" style="color: #360185; font-size: 0.95rem;">
                    <i class="bi bi-calendar-check me-2"></i>
                    <strong>{{ $events->count() }}</strong> Events Found
                    @if (request('category'))
                        in <strong>{{ $categories->find(request('category'))->name }}</strong>
                    @endif
                </h6>
                @if (request()->hasAny(['search', 'category', 'sort']))
                    <a href="{{ route('events') }}" class="btn btn-sm"
                        style="background: #360185; color: white; border-radius: 20px; padding: 6px 14px; font-weight: 600; font-size: 0.85rem; box-shadow: 0 2px 10px rgba(54, 1, 133, 0.3);">
                        <i class="bi bi-x-circle me-1"></i>Clear Filters
                    </a>
                @endif
            </div>

            <!-- Events Grid -->
            @if ($events->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach ($events as $event)
                        <div class="col-lg-4 col-md-6 event-item">
                            <div class="card event-card"
                                onclick="window.location='{{ route('events.show', $event->id) }}'">
                                <div class="position-relative">
                                    <img src="{{ asset('images/Coming_Soon1.jpg') }}" alt="{{ $event->name }}"
                                        class="card-img-top">
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
                                    <div class="mt-auto text-muted small">
                                        @php
                                            $capacity = $event->capacity ?? 0;
                                            $registered = $event->event_registers_count ?? 0;
                                            $remaining = $capacity - $registered;
                                        @endphp
                                        <i class="bi bi-people-fill me-1"></i>
                                        {{ number_format($remaining) }} {{ $remaining === 1 ? 'slot' : 'slots' }}
                                        remaining
                                        @if ($remaining <= 10 && $remaining > 0)
                                            <span class="text-danger ms-2">
                                                <i class="bi bi-exclamation-circle"></i> Almost full!
                                            </span>
                                        @elseif($remaining === 0)
                                            <span class="text-danger ms-2">
                                                <i class="bi bi-x-circle"></i> Sold out
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($events->count() > 9)
                    <div class="d-flex justify-content-center align-items-center mt-5 gap-3">
                        <button id="prev-btn" class="btn"
                            style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1;">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <div id="pagination-dots" class="d-flex gap-2">
                            @for ($i = 0; $i < ceil($events->count() / 9); $i++)
                                <span class="pagination-dot" data-page="{{ $i + 1 }}"
                                    style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $i === 0 ? '#360185' : '#d0d0d0' }}; cursor: pointer; transition: all 0.3s ease;"></span>
                            @endfor
                        </div>
                        <button id="next-btn" class="btn"
                            style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1;">
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                @endif
            @else
                <!-- No Events Found -->
                <div class="no-events">
                    <i class="bi bi-calendar-x"></i>
                    <h3 style="color: #360185;">No Events Found</h3>
                    <p class="text-muted">
                        @if (request()->hasAny(['search', 'category']))
                            Try adjusting your filters to find more events.
                        @else
                            There are no events available at the moment. Check back soon!
                        @endif
                    </p>
                    @if (request()->hasAny(['search', 'category', 'sort']))
                        <a href="{{ route('events') }}" class="btn btn-lg mt-3"
                            style="background-color: #F4B342; color: #360185;">
                            <i class="bi bi-arrow-counterclockwise me-2"></i>View All Events
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Events Pagination
        let currentPage = 1;
        const itemsPerPage = 9;
        const totalEvents = {{ $events->count() }};
        const totalPages = Math.ceil(totalEvents / itemsPerPage);

        function changePage(direction) {
            const newPage = currentPage + direction;

            // Check boundaries
            if (newPage < 1 || newPage > totalPages) {
                return;
            }

            currentPage = newPage;
            updateDisplay();
        }

        function goToPage(page) {
            currentPage = page;
            updateDisplay();
        }

        function updateDisplay() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            // Hide all items
            const items = document.querySelectorAll('.event-item');
            items.forEach((item, index) => {
                if (index >= startIndex && index < endIndex) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });

            // Update dots
            const dots = document.querySelectorAll('.pagination-dot');
            dots.forEach((dot, index) => {
                if (index + 1 === currentPage) {
                    dot.style.backgroundColor = '#360185';
                    dot.style.transform = 'scale(1.2)';
                } else {
                    dot.style.backgroundColor = '#d0d0d0';
                    dot.style.transform = 'scale(1)';
                }
            });

            // Update button states
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            if (prevBtn && nextBtn) {
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;

                // Add opacity for disabled state
                prevBtn.style.opacity = currentPage === 1 ? '0.3' : '1';
                nextBtn.style.opacity = currentPage === totalPages ? '0.3' : '1';
                prevBtn.style.cursor = currentPage === 1 ? 'not-allowed' : 'pointer';
                nextBtn.style.cursor = currentPage === totalPages ? 'not-allowed' : 'pointer';
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (totalPages > 0) {
                updateDisplay();
            }

            // Add event listeners for pagination buttons
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    changePage(-1);
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    changePage(1);
                });
            }

            // Add event listeners for dots
            const dots = document.querySelectorAll('.pagination-dot');
            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    const page = parseInt(this.getAttribute('data-page'));
                    goToPage(page);
                });
            });
        });
    </script>
@endpush
