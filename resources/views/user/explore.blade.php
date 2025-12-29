@extends('layouts.app')

@section('title', 'Explore - Festivo')

@push('styles')
    <style>
        .explore-hero {
            background: linear-gradient(135deg, #360185 0%, #8F0177 50%, #DE1A58 100%);
            padding: 100px 0 80px;
            margin-top: -70px;
            padding-top: 140px;
        }

        .category-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(54, 1, 133, 0.2);
        }

        .category-card .card-img-overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .feature-box {
            padding: 2rem;
            border-radius: 15px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(54, 1, 133, 0.15);
        }

        .stat-box {
            text-align: center;
            padding: 2rem;
            border-radius: 15px;
            background: linear-gradient(135deg, rgba(54, 1, 133, 0.05) 0%, rgba(143, 1, 119, 0.05) 100%);
        }

        .vendor-card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .vendor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(54, 1, 133, 0.2);
        }

        .vendor-card img,
        .vendor-card > div:first-child {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .vendor-card .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .vendor-card h5 {
            height: 3.6rem;
            line-height: 1.8rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .vendor-card .venue-info {
            height: 1.5rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .vendor-card .description-info {
            height: 3rem;
            line-height: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .vendor-card .btn {
            margin-top: auto;
        }

        .testimonial-box {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('content')
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-auto" role="alert" style="max-width: 600px; position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-auto" role="alert" style="max-width: 600px; position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Hero Section -->
    <section class="explore-hero text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4">Discover Amazing Events</h1>
                    <p class="fs-5 mb-4 opacity-90">
                        Explore the most exciting events happening across Indonesia. From weddings to concerts and festivals, 
                        discover experiences that create lasting memories.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="/events" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: #F4B342; color: #360185; border: none; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='white';"
                            onmouseout="this.style.backgroundColor='#F4B342';">
                            Browse Events
                        </a>
                        <a href="/contact" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: transparent; color: white; border: 2px solid white; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='white'; this.style.color='#360185';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">
                            Contact Us
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Stats Grid -->
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">{{ $totalEvents }}+</h2>
                                <p class="text-white mb-0 fw-semibold">Amazing Events</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">{{ number_format($totalAttendees) }}+</h2>
                                <p class="text-white mb-0 fw-semibold">Event Capacity</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">{{ $categories->count() }}+</h2>
                                <p class="text-white mb-0 fw-semibold">Event Categories</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">25+</h2>
                                <p class="text-white mb-0 fw-semibold">Cities Covered</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Categories Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Browse Events by Category</h2>
                <p class="text-muted fs-5">Find the perfect event for every occasion</p>
            </div>

            <div class="row g-4">
                @php
                    $gradients = [
                        'linear-gradient(135deg, #360185 0%, #8F0177 100%)',
                        'linear-gradient(135deg, #8F0177 0%, #DE1A58 100%)',
                        'linear-gradient(135deg, #DE1A58 0%, #F4B342 100%)',
                        'linear-gradient(135deg, #F4B342 0%, #360185 100%)',
                        'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                        'linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)',
                    ];
                @endphp
                @foreach($categories as $index => $category)
                    <div class="col-md-4">
                        <div class="card category-card border-0">
                            <div style="height: 300px; background: {{ $gradients[$index % count($gradients)] }};"></div>
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                <h3 class="text-white fw-bold mb-2">{{ $category->name }}</h3>
                                <p class="text-white mb-3 opacity-90">{{ $category->events_count }} events available</p>
                                <a href="{{ route('events', ['category' => $category->id]) }}" class="btn btn-light fw-semibold" 
                                    style="width: fit-content;">
                                    View Events <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
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
                            Browse through hundreds of amazing events across multiple categories. Find experiences that match your interests.
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
                            Simple and secure event registration process. Manage all your event registrations in one convenient dashboard.
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
                            All events are thoroughly verified and trusted. Read reviews from real attendees before registering.
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

    <!-- Featured Events Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Featured Events</h2>
                <p class="text-muted fs-5">Popular events happening near you</p>
            </div>

            <div class="row g-4">
                @forelse($featuredEvents as $event)
                    <div class="col-md-4">
                        <div class="card vendor-card border-0 shadow-sm" style="cursor: pointer; transition: all 0.3s ease;" onclick="window.location='{{ route('events.show', $event->id) }}'">
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
                            <div style="background: {{ $gradients[$gradientIndex] }}; height: 250px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-calendar-event" style="font-size: 4rem; color: rgba(255, 255, 255, 0.3);"></i>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge" style="background-color: #F4B342; color: #360185; font-weight: 600;">
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
                                    <small class="text-muted">
                                        <i class="bi bi-people me-1"></i>{{ number_format($event->max_attends ?? $event->capacity ?? 0) }} capacity
                                    </small>
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
                            "Amazing platform to discover quality events. Our corporate event experience exceeded expectations!"
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
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
@endpush