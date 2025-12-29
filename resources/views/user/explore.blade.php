@extends('layouts.app')

@section('title', 'Explore - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/explore.css') }}">
@endpush

@section('content')
    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert"
            style="max-width: 600px; position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert"
            style="max-width: 600px; position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="explore-hero text-white">
        <div class="pattern-dots"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-content">
                        <div class="mb-4" style="animation: fadeInUp 0.6s ease-out;">
                            <span class="badge px-3 py-2"
                                style="background-color: rgba(244, 179, 66, 0.2); color: #F4B342; font-size: 0.9rem; font-weight: 600; border: 1px solid rgba(244, 179, 66, 0.3);">
                                <i class="bi bi-stars me-2"></i>Welcome to Festivo
                            </span>
                        </div>
                        <h1 class="hero-title" style="animation: fadeInUp 0.6s ease-out 0.1s backwards;">
                            Discover Amazing Events
                        </h1>
                        <p class="hero-subtitle mb-4" style="animation: fadeInUp 0.6s ease-out 0.2s backwards;">
                            Explore the most exciting events happening across Indonesia. From weddings to concerts and
                            festivals,
                            discover experiences that create lasting memories.
                        </p>
                        <div class="d-flex gap-3 flex-wrap" style="animation: fadeInUp 0.6s ease-out 0.3s backwards;">
                            <a href="/events" class="btn btn-primary-custom">
                                <i class="bi bi-calendar-event me-2"></i>Browse Events
                            </a>
                            <a href="/contact" class="btn btn-outline-custom">
                                <i class="bi bi-envelope me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="stats-grid">
                        <div class="row g-3">
                            <div class="col-6" style="animation: fadeInUp 0.6s ease-out 0.4s backwards;">
                                <div class="stat-box">
                                    <i class="bi bi-calendar-event stat-icon"></i>
                                    <div class="stat-number">{{ $totalEvents }}+</div>
                                    <p class="stat-label">Amazing Events</p>
                                </div>
                            </div>
                            <div class="col-6" style="animation: fadeInUp 0.6s ease-out 0.5s backwards;">
                                <div class="stat-box">
                                    <i class="bi bi-people stat-icon"></i>
                                    <div class="stat-number">{{ number_format($totalAttendees) }}+</div>
                                    <p class="stat-label">Happy Attendees</p>
                                </div>
                            </div>
                            <div class="col-6" style="animation: fadeInUp 0.6s ease-out 0.6s backwards;">
                                <div class="stat-box">
                                    <i class="bi bi-grid stat-icon"></i>
                                    <div class="stat-number">{{ $categories->count() }}+</div>
                                    <p class="stat-label">Event Categories</p>
                                </div>
                            </div>
                            <div class="col-6" style="animation: fadeInUp 0.6s ease-out 0.7s backwards;">
                                <div class="stat-box">
                                    <i class="bi bi-geo-alt stat-icon"></i>
                                    <div class="stat-number">25+</div>
                                    <p class="stat-label">Cities Covered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Featured Events</h2>
                <p class="text-muted fs-5">Upcoming events happening soon</p>
            </div>

            <div class="row g-4">
                @forelse($featuredEvents as $event)
                    <div class="col-md-4">
                        <div class="card vendor-card border-0 shadow-sm" style="cursor: pointer; transition: all 0.3s ease;"
                            onclick="window.location='{{ route('events.show', $event->id) }}'">
                            <img src="{{ asset('images/Coming_Soon1.jpg') }}" alt="{{ $event->name }}"
                                style="height: 250px; width: 100%; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge"
                                        style="background-color: #F4B342; color: #360185; font-weight: 600;">
                                        {{ $event->category->name }}
                                    </span>
                                    <div class="ms-auto">
                                        <i class="bi bi-calendar-event text-primary"></i>
                                        <span class="fw-bold ms-1">{{ $event->event_date->format('M d') }}</span>
                                    </div>
                                </div>
                                <h5 class="fw-bold mb-2" style="color: #360185;">{{ $event->name }}</h5>
                                <p class="text-muted small mb-2 venue-info">
                                    <i class="bi bi-geo-alt me-1"></i> {{ $event->venue }}
                                </p>
                                <p class="text-muted mb-3 description-info">
                                    {{ $event->description }}
                                </p>
                                <div class="mt-auto pt-2">
                                    @php
                                        $capacity = $event->capacity ?? 0;
                                        $registered = $event->event_registers_count ?? 0;
                                        $remaining = $capacity - $registered;
                                    @endphp
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>{{ number_format($remaining) }}
                                        {{ $remaining === 1 ? 'slot' : 'slots' }} remaining
                                    </small>
                                    @if ($remaining <= 10 && $remaining > 0)
                                        <small class="text-danger ms-2">
                                            <i class="bi bi-exclamation-circle"></i> Almost full!
                                        </small>
                                    @elseif($remaining === 0)
                                        <small class="text-danger ms-2">
                                            <i class="bi bi-x-circle"></i> Sold out
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-calendar-x" style="font-size: 4rem; color: #e0e0e0;"></i>
                        <h5 class="mt-3 text-muted">No featured events available at the moment</h5>
                        <p class="text-muted">Check back soon for exciting events!</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="/events" class="btn btn-lg px-5 py-3 fw-semibold"
                    style="background-color: #360185; color: white; border-radius: 10px;">
                    View All Events <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Event Categories Section -->
    <section class="py-5" style="background-color: #f8f9fa;" id="categories-section">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Browse Events by Category</h2>
                <p class="text-muted fs-5">Find the perfect event for every occasion</p>
            </div>

            <div class="row g-4" id="categories-container">
                @foreach ($categories as $index => $category)
                    <div class="col-md-4 category-item" data-index="{{ $index }}"
                        style="display: {{ $index < 6 ? 'block' : 'none' }};">
                        <div class="card category-card border-0">
                            @if ($category->image)
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}"
                                    class="category-image" style="height: 300px; width: 100%; object-fit: cover;">
                            @else
                                <div style="height: 300px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%);">
                                </div>
                            @endif
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                <h3 class="text-white fw-bold mb-2">{{ $category->name }}</h3>
                                <p class="text-white mb-3 opacity-90">{{ $category->events_count }} events available</p>
                                <a href="{{ route('events', ['category' => $category->id]) }}"
                                    class="btn btn-light fw-semibold" style="width: fit-content;">
                                    View Events <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Controls -->
            @if ($categories->count() > 6)
                <div class="d-flex justify-content-center align-items-center mt-5 gap-3">
                    <button id="prev-btn" class="btn"
                        style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1;">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <div id="pagination-dots" class="d-flex gap-2">
                        @for ($i = 0; $i < ceil($categories->count() / 6); $i++)
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
        </div>
    </section>

    <!-- Why Choose Festivo Section -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Why Choose Festivo</h2>
                <p class="text-muted fs-5">Your gateway to unforgettable event experiences</p>
            </div>

            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%);">
                            <i class="bi bi-search fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Event Discovery</h4>
                        <p class="text-muted mb-0">
                            Browse through hundreds of amazing events across multiple categories. Find experiences that
                            match your interests.
                        </p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #8F0177 0%, #DE1A58 100%);">
                            <i class="bi bi-calendar-check fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Easy Registration</h4>
                        <p class="text-muted mb-0">
                            Simple and secure event registration process. Manage all your event registrations in one
                            convenient dashboard.
                        </p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);">
                            <i class="bi bi-shield-check fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Verified Events</h4>
                        <p class="text-muted mb-0">
                            All events are thoroughly verified and trusted. Read reviews from real attendees before
                            registering.
                        </p>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #F4B342 0%, #360185 100%);">
                            <i class="bi bi-chat-dots fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Event Updates</h4>
                        <p class="text-muted mb-0">
                            Get real-time updates about your registered events and never miss important announcements.
                        </p>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="bi bi-graph-up fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Personalized Recommendations</h4>
                        <p class="text-muted mb-0">
                            Get personalized event suggestions based on your interests and past attendance.
                        </p>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                            <i class="bi bi-headset fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">24/7 Support</h4>
                        <p class="text-muted mb-0">
                            Our dedicated support team is always ready to help you with any questions or concerns.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">What Our Clients Say</h2>
                <p class="text-muted fs-5">Real stories from real clients</p>
            </div>

            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-md-4">
                    <div class="testimonial-box">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-muted mb-4">
                            "Festivo helped us discover the perfect wedding event. The experience was unforgettable!"
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px; background-color: #360185; color: white; font-weight: 600;">
                                AS
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Amanda & Steven</h6>
                                <small class="text-muted">Wedding - Jakarta</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="col-md-4">
                    <div class="testimonial-box">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-muted mb-4">
                            "Amazing platform to discover quality events. Our corporate event experience exceeded
                            expectations!"
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px; background-color: #8F0177; color: white; font-weight: 600;">
                                RW
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Robert Wilson</h6>
                                <small class="text-muted">Corporate Event - Surabaya</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-md-4">
                    <div class="testimonial-box">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="text-muted mb-4">
                            "The best platform for event planning. Highly recommended for anyone planning an event!"
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 50px; height: 50px; background-color: #DE1A58; color: white; font-weight: 600;">
                                MP
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Maria Putri</h6>
                                <small class="text-muted">Birthday Party - Bandung</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Categories Pagination
        let currentPage = 1;
        const itemsPerPage = 6;
        const totalCategories = {{ $categories->count() }};
        const totalPages = Math.ceil(totalCategories / itemsPerPage);

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
            const items = document.querySelectorAll('.category-item');
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

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Add keyframe animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
    </script>
@endpush
