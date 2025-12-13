@extends('layouts.app')

@section('title', 'Festivo - Platform Manajemen Event & Vendor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="padding: 120px 0; margin-top: -70px; padding-top: 190px; min-height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="text-muted mb-3 text-uppercase" style="letter-spacing: 2px; font-weight: 500; font-size: 0.9rem;">
                        Host events — without losing your mind.
                    </p>
                    <h1 class="display-3 fw-bold mb-4 lh-sm" style="color: #360185; font-size: 3.5rem;">
                        Plan and launch your event with confidence.
                    </h1>
                    <p class="fs-5 mb-5 text-muted lh-lg mx-auto" style="max-width: 900px;">
                        Festivo helps organizers create events, sell tickets, manage schedules, and connect sponsors while giving attendees a smooth registration experience from start to finish.
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

    <!-- Event Categories Section -->
    <section class="py-5" style="background-color: #F4B342;">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-10 mx-auto">
                    <!-- Feature Categories with Icons on Left -->
                    <div class="row align-items-start g-4">
                        <!-- Left Side - Icon Categories -->
                        <div class="col-lg-3">
                            <div class="d-flex flex-column gap-4">
                                <!-- Venue Category -->
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3" 
                                    style="background-color: #f8f9fa; cursor: pointer; transition: all 0.3s ease;"
                                    onmouseover="this.style.backgroundColor='#e9ecef';"
                                    onmouseout="this.style.backgroundColor='#f8f9fa';">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                        style="width: 50px; height: 50px; background-color: #360185; flex-shrink: 0;">
                                        <i class="bi bi-geo-alt" style="font-size: 1.5rem; color: white;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold" style="color: #360185;">Venue</h6>
                                    </div>
                                </div>

                                <!-- Food & Beverage Category -->
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3" 
                                    style="background-color: #f8f9fa; cursor: pointer; transition: all 0.3s ease;"
                                    onmouseover="this.style.backgroundColor='#e9ecef';"
                                    onmouseout="this.style.backgroundColor='#f8f9fa';">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                        style="width: 50px; height: 50px; background-color: #8F0177; flex-shrink: 0;">
                                        <i class="bi bi-cup-straw" style="font-size: 1.5rem; color: white;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold" style="color: #360185;">Food & Beverage</h6>
                                    </div>
                                </div>

                                <!-- Logistics Category -->
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3" 
                                    style="background-color: #f8f9fa; cursor: pointer; transition: all 0.3s ease;"
                                    onmouseover="this.style.backgroundColor='#e9ecef';"
                                    onmouseout="this.style.backgroundColor='#f8f9fa';">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle" 
                                        style="width: 50px; height: 50px; background-color: #DE1A58; flex-shrink: 0;">
                                        <i class="bi bi-truck" style="font-size: 1.5rem; color: #360185;"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-semibold" style="color: #360185;">Logistics</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Event Preview Cards -->
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <!-- Event Card 1 -->
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)';">
                                        <div class="position-relative overflow-hidden" style="height: 200px; border-radius: 12px 12px 0 0;">
                                            <div class="w-100 h-100" style="background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);"></div>
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-calendar-event" style="font-size: 3rem; color: #360185; opacity: 0.3;"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                                                style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                                                <span class="badge" style="background-color: #360185; font-weight: 600;">Conference</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="fw-semibold mb-2" style="color: #360185; font-size: 0.95rem;">
                                                MILLER FAMILY REUNION
                                            </h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                                <i class="bi bi-people me-1"></i> 150 Guests
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Card 2 -->
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)';">
                                        <div class="position-relative overflow-hidden" style="height: 200px; border-radius: 12px 12px 0 0;">
                                            <div class="w-100 h-100" style="background: linear-gradient(135deg, #360185 0%, #8F0177 100%);"></div>
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-music-note-beamed" style="font-size: 3rem; color: white; opacity: 0.3;"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                                                style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                                                <span class="badge" style="background-color: #360185; font-weight: 600;">Dance</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="fw-semibold mb-2" style="color: #360185; font-size: 0.95rem;">
                                                SUMMER DANCE FESTIVAL
                                            </h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                                <i class="bi bi-people me-1"></i> 500 Guests
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Card 3 -->
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)';"
                                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)';">
                                        <div class="position-relative overflow-hidden" style="height: 200px; border-radius: 12px 12px 0 0;">
                                            <div class="w-100 h-100" style="background: linear-gradient(135deg, #F4B342 0%, #DE1A58 100%);"></div>
                                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                                <i class="bi bi-ticket-perforated" style="font-size: 3rem; color: #360185; opacity: 0.3;"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                                                style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                                                <span class="badge" style="background-color: #360185; font-weight: 600;">Entertainment</span>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="fw-semibold mb-2" style="color: #360185; font-size: 0.95rem;">
                                                TECH INNOVATION EXPO
                                            </h6>
                                            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                                                <i class="bi bi-people me-1"></i> 1000+ Guests
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Feature Tags -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                                        <span class="badge px-4 py-2" style="background-color: #360185; color: white; font-size: 0.9rem; font-weight: 500; border-radius: 20px;">
                                            <i class="bi bi-star me-1"></i> Guest Communications
                                        </span>
                                        <span class="badge px-4 py-2" style="background-color: #8F0177; color: white; font-size: 0.9rem; font-weight: 500; border-radius: 20px;">
                                            <i class="bi bi-check-circle me-1"></i> Email & SMS
                                        </span>
                                        <span class="badge px-4 py-2" style="background-color: #DE1A58; color: #360185; font-size: 0.9rem; font-weight: 500; border-radius: 20px;">
                                            <i class="bi bi-gift me-1"></i> Event GoLive
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background-color: #DE1A58;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-4" style="color: #360185;">
                        Ready to make your event unforgettable?
                    </h2>
                    <p class="fs-5 text-muted mb-5">
                        Join thousands of event organizers who trust Festivo for their special occasions
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="/contact" class="btn btn-lg px-5 py-3 fw-semibold"
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


