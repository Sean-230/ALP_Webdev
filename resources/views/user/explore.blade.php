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
        }

        .vendor-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(54, 1, 133, 0.2);
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
    <!-- Hero Section -->
    <section class="explore-hero text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4">Explore Amazing Events & Vendors</h1>
                    <p class="fs-5 mb-4 opacity-90">
                        Discover the best event vendors and services across Indonesia. From weddings to corporate events, 
                        find everything you need in one place.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="/vendors" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: #F4B342; color: #360185; border: none; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='white';"
                            onmouseout="this.style.backgroundColor='#F4B342';">
                            Browse Vendors
                        </a>
                        <a href="/events" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: transparent; color: white; border: 2px solid white; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='white'; this.style.color='#360185';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">
                            View Events
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Stats Grid -->
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">250+</h2>
                                <p class="text-white mb-0 fw-semibold">Verified Vendors</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">1000+</h2>
                                <p class="text-white mb-0 fw-semibold">Successful Events</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box" style="background-color: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px);">
                                <h2 class="display-4 fw-bold text-white mb-2">50K+</h2>
                                <p class="text-white mb-0 fw-semibold">Happy Clients</p>
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
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Browse by Event Category</h2>
                <p class="text-muted fs-5">Find the perfect vendors for your specific event type</p>
            </div>

            <div class="row g-4">
                <!-- Wedding Category -->
                <div class="col-md-4">
                    <div class="card category-card border-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%);"></div>
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="text-white fw-bold mb-2">Wedding</h3>
                            <p class="text-white mb-3 opacity-90">Make your special day unforgettable</p>
                            <a href="/vendors?category=wedding" class="btn btn-light fw-semibold" 
                                style="width: fit-content;">
                                Explore <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Conference Category -->
                <div class="col-md-4">
                    <div class="card category-card border-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #8F0177 0%, #DE1A58 100%);"></div>
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="text-white fw-bold mb-2">Conference</h3>
                            <p class="text-white mb-3 opacity-90">Professional event solutions</p>
                            <a href="/vendors?category=conference" class="btn btn-light fw-semibold" 
                                style="width: fit-content;">
                                Explore <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Concert Category -->
                <div class="col-md-4">
                    <div class="card category-card border-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);"></div>
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="text-white fw-bold mb-2">Concert & Music</h3>
                            <p class="text-white mb-3 opacity-90">Create amazing live experiences</p>
                            <a href="/vendors?category=concert" class="btn btn-light fw-semibold" 
                                style="width: fit-content;">
                                Explore <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Festival Category -->
                <div class="col-md-4">
                    <div class="card category-card border-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #F4B342 0%, #360185 100%);"></div>
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="text-white fw-bold mb-2">Festival</h3>
                            <p class="text-white mb-3 opacity-90">Large-scale event management</p>
                            <a href="/vendors?category=festival" class="btn btn-light fw-semibold" 
                                style="width: fit-content;">
                                Explore <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Corporate Category -->
                <div class="col-md-4">
                    <div class="card category-card border-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="text-white fw-bold mb-2">Corporate Event</h3>
                            <p class="text-white mb-3 opacity-90">Business events & team building</p>
                            <a href="/vendors?category=corporate" class="btn btn-light fw-semibold" 
                                style="width: fit-content;">
                                Explore <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Exhibition Category -->
                <div class="col-md-4">
                    <div class="card category-card border-0">
                        <div style="height: 300px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);"></div>
                        <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                            <h3 class="text-white fw-bold mb-2">Exhibition</h3>
                            <p class="text-white mb-3 opacity-90">Showcase your products & services</p>
                            <a href="/vendors?category=exhibition" class="btn btn-light fw-semibold" 
                                style="width: fit-content;">
                                Explore <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">What We Offer</h2>
                <p class="text-muted fs-5">Comprehensive event solutions for every need</p>
            </div>

            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                            style="width: 80px; height: 80px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%);">
                            <i class="bi bi-search fs-2 text-white"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #360185;">Vendor Discovery</h4>
                        <p class="text-muted mb-0">
                            Browse through hundreds of verified vendors across multiple categories. Find the perfect match for your event.
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
                        <h4 class="fw-bold mb-3" style="color: #360185;">Easy Booking</h4>
                        <p class="text-muted mb-0">
                            Simple and secure booking process. Manage all your event vendors in one convenient dashboard.
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
                        <h4 class="fw-bold mb-3" style="color: #360185;">Verified Quality</h4>
                        <p class="text-muted mb-0">
                            All vendors are thoroughly vetted and verified. Read reviews from real clients before booking.
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
                        <h4 class="fw-bold mb-3" style="color: #360185;">Direct Communication</h4>
                        <p class="text-muted mb-0">
                            Chat directly with vendors to discuss your requirements and get instant quotes.
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
                        <h4 class="fw-bold mb-3" style="color: #360185;">Event Analytics</h4>
                        <p class="text-muted mb-0">
                            Track your event planning progress and get insights to make better decisions.
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

    <!-- Featured Vendors Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Featured Vendors</h2>
                <p class="text-muted fs-5">Top-rated vendors trusted by thousands</p>
            </div>

            <div class="row g-4">
                <!-- Vendor 1 -->
                <div class="col-md-4">
                    <div class="card vendor-card border-0 shadow-sm">
                        <div style="height: 250px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%);"></div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge" style="background-color: #F4B342; color: #360185; font-weight: 600;">
                                    Wedding
                                </span>
                                <div class="ms-auto">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="fw-bold ms-1">4.9</span>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: #360185;">Elite Wedding Planners</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt me-1"></i> Jakarta, Indonesia
                            </p>
                            <p class="text-muted mb-4">
                                Full-service wedding planning with attention to every detail
                            </p>
                            <a href="/vendors" class="btn btn-sm w-100" 
                                style="background-color: #360185; color: white; font-weight: 600;">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vendor 2 -->
                <div class="col-md-4">
                    <div class="card vendor-card border-0 shadow-sm">
                        <div style="height: 250px; background: linear-gradient(135deg, #8F0177 0%, #DE1A58 100%);"></div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge" style="background-color: #F4B342; color: #360185; font-weight: 600;">
                                    Catering
                                </span>
                                <div class="ms-auto">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="fw-bold ms-1">4.8</span>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: #360185;">Gourmet Catering Co.</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt me-1"></i> Surabaya, Indonesia
                            </p>
                            <p class="text-muted mb-4">
                                Premium catering services for all types of events
                            </p>
                            <a href="/vendors" class="btn btn-sm w-100" 
                                style="background-color: #360185; color: white; font-weight: 600;">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vendor 3 -->
                <div class="col-md-4">
                    <div class="card vendor-card border-0 shadow-sm">
                        <div style="height: 250px; background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);"></div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge" style="background-color: #F4B342; color: #360185; font-weight: 600;">
                                    Photography
                                </span>
                                <div class="ms-auto">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="fw-bold ms-1">5.0</span>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-2" style="color: #360185;">Moment Capture Studios</h5>
                            <p class="text-muted small mb-3">
                                <i class="bi bi-geo-alt me-1"></i> Bandung, Indonesia
                            </p>
                            <p class="text-muted mb-4">
                                Professional photography and videography services
                            </p>
                            <a href="/vendors" class="btn btn-sm w-100" 
                                style="background-color: #360185; color: white; font-weight: 600;">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="/vendors" class="btn btn-lg px-5 py-3 fw-semibold"
                    style="background-color: #360185; color: white; border-radius: 10px;">
                    View All Vendors <i class="bi bi-arrow-right ms-2"></i>
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
                            "Festivo made planning our wedding so much easier. We found amazing vendors all in one place!"
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
                            "Professional vendors and excellent service. Our corporate event was a huge success!"
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