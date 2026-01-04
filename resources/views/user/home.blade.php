@extends('layouts.app')

@section('title', 'Festivo - Platform Manajemen Event & Vendor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user-home.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section"
        style="padding: 120px 0; margin-top: -70px; padding-top: 190px; min-height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="text-muted mb-3 text-uppercase"
                        style="letter-spacing: 2px; font-weight: 500; font-size: 0.9rem;">
                        Host events — without losing your mind.
                    </p>
                    <h1 class="display-3 fw-bold mb-4 lh-sm" style="color: #360185; font-size: 3.5rem;">
                        Plan and launch your event with confidence.
                    </h1>
                    <p class="fs-5 mb-5 text-muted lh-lg mx-auto" style="max-width: 900px;">
                        Festivo helps organizers create events, sell tickets, manage schedules, and connect sponsors while
                        giving attendees a smooth registration experience from start to finish.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="/vendors" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: #F4B342; color: #360185; border: 2px solid #DE1A58; border-radius: 10px; transition: all 0.3s ease; font-weight: 600;"
                            onmouseover="this.style.backgroundColor='#DE1A58'; this.style.borderColor='#8F0177'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.backgroundColor='#F4B342'; this.style.borderColor='#DE1A58'; this.style.transform='translateY(0)';">
                            Why Festivo
                        </a>
                        <a href="/events" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: #360185; color: white; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#8F0177'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.backgroundColor='#360185'; this.style.transform='translateY(0)';">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Next Upcoming Event</h2>
                <p class="text-muted fs-5">Don't miss out on the next exciting event</p>
            </div>
            @if ($upcomingEvent)
                <div class="row g-4 mb-5">
                    <!-- Featured Event Card -->
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 h-100"
                            style="border-radius: 20px; overflow: hidden; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 8px 30px rgba(54, 1, 133, 0.15);"
                            onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 40px rgba(54, 1, 133, 0.25)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 30px rgba(54, 1, 133, 0.15)';">
                            <div class="row g-0">
                                <!-- Event Image -->
                                <div class="col-md-6">
                                    <div class="position-relative h-100" style="min-height: 400px;">
                                        @if($upcomingEvent->event_picture)
                                            <img src="{{ asset($upcomingEvent->event_picture) }}" alt="{{ $upcomingEvent->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/Exclamation.jpg') }}" alt="{{ $upcomingEvent->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @endif
                                        <div class="position-absolute top-0 start-0 p-4">
                                            <span class="badge px-3 py-2"
                                                style="background-color: #F4B342; color: #360185; font-weight: 600; font-size: 0.9rem;">
                                                <i class="bi bi-lightning-fill me-1"></i>
                                                {{ $upcomingEvent->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Event Details -->
                                <div class="col-md-6">
                                    <div class="card-body p-5 d-flex flex-column justify-content-center h-100">
                                        <div class="mb-4">
                                            <span class="badge px-3 py-2 mb-3"
                                                style="background-color: rgba(54, 1, 133, 0.1); color: #360185; font-weight: 600;">
                                                Upcoming Event
                                            </span>
                                        </div>
                                        <h3 class="fw-bold mb-3" style="color: #360185;">{{ $upcomingEvent->name }}</h3>
                                        <p class="text-muted mb-4 fs-6">
                                            {{ Str::limit($upcomingEvent->description, 150) }}
                                        </p>

                                        <div class="mb-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-calendar3 fs-5 me-3" style="color: #8F0177;"></i>
                                                <div>
                                                    <small class="text-muted d-block">Date</small>
                                                    <span class="fw-semibold"
                                                        style="color: #360185;">{{ $upcomingEvent->event_date->format('F d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="bi bi-geo-alt fs-5 me-3" style="color: #DE1A58;"></i>
                                                <div>
                                                    <small class="text-muted d-block">Location</small>
                                                    <span class="fw-semibold"
                                                        style="color: #360185;">{{ $upcomingEvent->venue }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-people fs-5 me-3" style="color: #F4B342;"></i>
                                                <div>
                                                    <small class="text-muted d-block">Slots Remaining</small>
                                                    @php
                                                        $maxAttends =
                                                            $upcomingEvent->max_attends ??
                                                            ($upcomingEvent->capacity ?? 0);
                                                        $registeredCount = $upcomingEvent->eventRegisters->whereIn('payment_status', ['pending', 'paid'])->sum(
                                                            'ticket_qty',
                                                        );
                                                        $remaining = $maxAttends - $registeredCount;
                                                    @endphp
                                                    <span class="fw-semibold" style="color: #360185;">{{ $remaining }} /
                                                        {{ $maxAttends }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <a href="{{ route('events.show', $upcomingEvent->id) }}"
                                                class="btn btn-lg px-5 fw-semibold"
                                                style="background-color: #360185; color: white; border-radius: 10px; transition: all 0.3s ease;"
                                                onmouseover="this.style.backgroundColor='#8F0177';"
                                                onmouseout="this.style.backgroundColor='#360185';">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <div class="p-5">
                            <i class="bi bi-calendar-x" style="font-size: 4rem; color: #d0d0d0;"></i>
                            <h4 class="mt-3" style="color: #360185;">No Upcoming Events</h4>
                            <p class="text-muted">Check back soon for new exciting events!</p>
                            <a href="{{ route('events') }}" class="btn btn-lg px-4 fw-semibold mt-3"
                                style="background-color: #360185; color: white; border-radius: 10px;">
                                Browse All Events
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Festivo Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
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
                            style="width: 80px; height: 80px; background: #360185;">
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
                            style="width: 80px; height: 80px; background: #8F0177;">
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
                            style="width: 80px; height: 80px; background: #DE1A58;">
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
                            style="width: 80px; height: 80px; background: #F4B342;">
                            <i class="bi bi-people fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">F&B Vendors</h4>
                        <p class="text-muted mb-0">
                            Event managers can book quality food and beverage vendors to provide catering services for their
                            events.
                        </p>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: #667eea;">
                            <i class="bi bi-graph-up fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Event Management</h4>
                        <p class="text-muted mb-0">
                            Create and manage your own events as an event manager. Track registrations and manage all
                            aspects.
                        </p>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: #a8edea;">
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
                    <div class="card border-0 p-4 h-100"
                        style="box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 15px;">
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
                        <div class="d-flex align-items-center mt-auto">
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
                    <div class="card border-0 p-4 h-100"
                        style="box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 15px;">
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
                        <div class="d-flex align-items-center mt-auto">
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
                    <div class="card border-0 p-4 h-100"
                        style="box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 15px;">
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
                        <div class="d-flex align-items-center mt-auto">
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
