@extends('layouts.app')

@section('title', 'Festivo - Platform Manajemen Event & Vendor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
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
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Events Happening Now</h2>
                <p class="text-muted fs-5">Join the most popular events taking place right now</p>
            </div>
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
                                <div class="position-relative h-100"
                                    style="min-height: 400px; background: linear-gradient(135deg, #360185 0%, #8F0177 50%, #DE1A58 100%);">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-calendar-event"
                                            style="font-size: 6rem; color: white; opacity: 0.2;"></i>
                                    </div>
                                    <div class="position-absolute top-0 start-0 p-4">
                                        <span class="badge px-3 py-2"
                                            style="background-color: #F4B342; font-weight: 600; font-size: 0.9rem;">
                                            <i class="bi bi-lightning-fill me-1"></i> Happening Now
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
                                            Featured Event
                                        </span>
                                    </div>
                                    <h3 class="fw-bold mb-3" style="color: #360185;">Summer Music Festival 2025</h3>
                                    <p class="text-muted mb-4 fs-6">
                                        Join us for an unforgettable evening of live music, entertainment, and community
                                        gathering.
                                        Experience the best local and international artists in one spectacular venue.
                                    </p>

                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-calendar3 fs-5 me-3" style="color: #8F0177;"></i>
                                            <div>
                                                <small class="text-muted d-block">Date</small>
                                                <span class="fw-semibold" style="color: #360185;">December 25, 2025</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bi bi-geo-alt fs-5 me-3" style="color: #DE1A58;"></i>
                                            <div>
                                                <small class="text-muted d-block">Location</small>
                                                <span class="fw-semibold" style="color: #360185;">Central Park Arena</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-people fs-5 me-3" style="color: #F4B342;"></i>
                                            <div>
                                                <small class="text-muted d-block">Attendees</small>
                                                <span class="fw-semibold" style="color: #360185;">500+ Registered</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-3">
                                        <a href="/events" class="btn btn-lg px-4 fw-semibold"
                                            style="background-color: #360185; color: white; border-radius: 10px; transition: all 0.3s ease;"
                                            onmouseover="this.style.backgroundColor='#8F0177';"
                                            onmouseout="this.style.backgroundColor='#360185';">
                                            View Details
                                        </a>
                                        <a href="/events" class="btn btn-lg px-4 fw-semibold"
                                            style="background-color: white; color: #360185; border: 2px solid #360185; border-radius: 10px; transition: all 0.3s ease;"
                                            onmouseover="this.style.backgroundColor='#f8f9fa';"
                                            onmouseout="this.style.backgroundColor='white';">
                                            Register Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Unforgettable Events Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Create Unforgettable Event Experiences</h2>
                <p class="text-muted fs-5">Everything you need to make your event successful</p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 - Music -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 p-4"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px;">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; background: rgba(255,255,255,0.2);">
                                <i class="bi bi-music-note-beamed fs-2 text-white"></i>
                            </div>
                        </div>
                        <h4 class="text-white fw-bold mb-3">Music</h4>
                        <p class="text-white opacity-90 mb-0">
                            Coordinate with top musicians and DJs to create the perfect atmosphere for your event
                        </p>
                    </div>
                </div>

                <!-- Feature 2 - Brights -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 p-4"
                        style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 20px;">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; background: rgba(255,255,255,0.2);">
                                <i class="bi bi-lightbulb fs-2 text-white"></i>
                            </div>
                        </div>
                        <h4 class="text-white fw-bold mb-3">Brights</h4>
                        <p class="text-white opacity-90 mb-0">
                            Professional lighting and stage design to highlight every moment of your event
                        </p>
                    </div>
                </div>

                <!-- Feature 3 - Holidays -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 p-4"
                        style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 20px;">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px; background: rgba(255,255,255,0.2);">
                                <i class="bi bi-gift fs-2 text-white"></i>
                            </div>
                        </div>
                        <h4 class="text-white fw-bold mb-3">Holidays</h4>
                        <p class="text-white opacity-90 mb-0">
                            Special themed events and holiday celebrations for memorable occasions
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Exciting Events Around the Corner -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Exciting Events Around the Corner</h2>
                <p class="text-muted fs-5">Discover upcoming events near you</p>
            </div>

            <!-- Event Filters -->
            <div class="d-flex justify-content-center gap-2 mb-5 flex-wrap">
                <button class="btn btn-sm px-4 py-2"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 20px; font-weight: 500;">
                    Upcoming
                </button>
                <button class="btn btn-sm px-4 py-2"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 20px; font-weight: 500;">
                    Online
                </button>
                <button class="btn btn-sm px-4 py-2"
                    style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 20px; font-weight: 500;">
                    Music
                </button>
                <button class="btn btn-sm px-4 py-2"
                    style="background-color: #F4B342; color: white; border: none; border-radius: 20px; font-weight: 600;">
                    Food & Drink
                </button>
            </div>

            <div class="row g-4">
                <!-- Event Card 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
                        <div style="height: 200px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%);"></div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #360185;">Flavor Fest</h5>
                            <p class="text-muted mb-3 small">
                                <i class="bi bi-geo-alt me-1"></i> Downtown Plaza
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar3" style="color: #8F0177;"></i>
                                    <span class="small text-muted">25 Dec</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                    <span class="fw-bold" style="color: #360185;">79</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
                        <div style="height: 200px; background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);"></div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #360185;">Sips & Bites</h5>
                            <p class="text-muted mb-3 small">
                                <i class="bi bi-geo-alt me-1"></i> Riverside Garden
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar3" style="color: #DE1A58;"></i>
                                    <span class="small text-muted">28 Dec</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                    <span class="fw-bold" style="color: #360185;">79</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 15px; overflow: hidden;">
                        <div style="height: 200px; background: linear-gradient(135deg, #8F0177 0%, #360185 100%);"></div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #360185;">Gourmet Gathering</h5>
                            <p class="text-muted mb-3 small">
                                <i class="bi bi-geo-alt me-1"></i> City Convention Center
                            </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar3" style="color: #8F0177;"></i>
                                    <span class="small text-muted">30 Dec</span>
                                </div>
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                    <span class="fw-bold" style="color: #360185;">79</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Discover Events Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Discover Events Beyond Expectations</h2>
                <p class="text-muted fs-5">Explore unique experiences worldwide</p>
            </div>

            <div class="row g-4">
                <!-- Large Card - Explore Events -->
                <div class="col-lg-4">
                    <div class="card border-0 h-100 p-4"
                        style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); border-radius: 20px;">
                        <div class="mb-4">
                            <i class="bi bi-globe2 fs-1" style="color: #360185;"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Explore Events Around the World</h4>
                        <p class="text-muted mb-4">
                            Discover amazing events happening globally. From concerts to conferences, find your next
                            adventure.
                        </p>
                        <button class="btn btn-lg mt-auto"
                            style="background-color: #360185; color: white; border-radius: 10px; font-weight: 600;">
                            Browse Events
                        </button>
                    </div>
                </div>

                <!-- Medium Cards Grid -->
                <div class="col-lg-8">
                    <div class="row g-4 h-100">
                        <!-- Free Webinar -->
                        <div class="col-md-6">
                            <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                                <div style="height: 150px; background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-2" style="color: #360185;">Free Webinar</h5>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-calendar3 me-1"></i> 15 Jan
                                    </p>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                        <span class="fw-bold" style="color: #360185;">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Climate Bridge -->
                        <div class="col-md-6">
                            <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                                <div style="height: 150px; background: linear-gradient(135deg, #ff9a56 0%, #ff6a88 100%);">
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-2" style="color: #360185;">Climate Bridge</h5>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-calendar3 me-1"></i> 20 Jan
                                    </p>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                        <span class="fw-bold" style="color: #360185;">69</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Epic Adventures -->
                        <div class="col-md-6">
                            <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                                <div style="height: 150px; background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);">
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-2" style="color: #360185;">Epic Adventures</h5>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-calendar3 me-1"></i> 25 Jan
                                    </p>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                        <span class="fw-bold" style="color: #360185;">69</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Limitless Adventures -->
                        <div class="col-md-6">
                            <div class="card border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                                <div style="height: 150px; background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);">
                                </div>
                                <div class="card-body p-4">
                                    <h5 class="fw-bold mb-2" style="color: #360185;">Limitless Adventures</h5>
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-calendar3 me-1"></i> 28 Jan
                                    </p>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="bi bi-currency-dollar" style="color: #360185;"></i>
                                        <span class="fw-bold" style="color: #360185;">89</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Local Events Card -->
                <div class="col-12">
                    <div class="card border-0 p-5"
                        style="background: linear-gradient(135deg, #fff0f0 0%, #ffe9e9 100%); border-radius: 20px;">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h3 class="fw-bold mb-3" style="color: #360185;">Local Events Taking Place Near You</h3>
                                <p class="text-muted fs-5 mb-0">
                                    Daily events are taking place in your city, don't miss connecting with friends and
                                    meeting new people
                                </p>
                            </div>
                            <div class="col-lg-4 text-end">
                                <button class="btn btn-lg px-5 py-3"
                                    style="background-color: #360185; color: white; border-radius: 10px; font-weight: 600;">
                                    Explore Local Events
                                </button>
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
