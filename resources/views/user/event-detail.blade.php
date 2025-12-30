@extends('layouts.app')

@section('title', $event->name . ' - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">
@endpush

@section('content')
    @php
        // Calculate availability variables at the top
        $registeredCount = $event->registrations->sum('ticket_qty');
        $maxAttends = $event->max_attends ?? ($event->capacity ?? 0);
        $availableSlots = $maxAttends - $registeredCount;
        $capacityPercentage = $maxAttends > 0 ? ($registeredCount / $maxAttends) * 100 : 0;
    @endphp

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
    <section class="event-detail-hero text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb text-white">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                    class="text-white text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('explore') }}"
                                    class="text-white text-decoration-none">Explore</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $event->name }}</li>
                        </ol>
                    </nav>
                    <span class="badge mb-3"
                        style="background-color: #F4B342; color: #360185; font-weight: 600; font-size: 1rem;">
                        {{ $event->category->name }}
                    </span>
                    <h1 class="display-4 fw-bold mb-3">{{ $event->name }}</h1>
                    <p class="fs-5 opacity-90">{{ $event->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Details Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Event Image -->
                    <div class="event-detail-card mb-4">
                        <div class="event-image-placeholder">
                            <img src="{{ asset('images/Coming_Soon1.jpg') }}" alt="{{ $event->name }}" class="w-100 h-100"
                                style="object-fit: cover;">
                        </div>
                    </div>

                    <!-- Event Information -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%); flex-shrink: 0;">
                                    <i class="bi bi-calendar-event text-white fs-4"></i>
                                </div>
                                <div class="info-content">
                                    <small class="text-muted d-block">Event Date</small>
                                    <strong style="color: #360185;">{{ $event->event_date->format('F d, Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px; background: linear-gradient(135deg, #8F0177 0%, #DE1A58 100%); flex-shrink: 0;">
                                    <i class="bi bi-clock text-white fs-4"></i>
                                </div>
                                <div class="info-content">
                                    <small class="text-muted d-block">Time</small>
                                    <strong style="color: #360185;">{{ $event->event_date->format('g:i A') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px; background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%); flex-shrink: 0;">
                                    <i class="bi bi-geo-alt text-white fs-4"></i>
                                </div>
                                <div class="info-content">
                                    <small class="text-muted d-block">Location</small>
                                    <strong style="color: #360185;">{{ $event->venue }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                    style="width: 50px; height: 50px; background: linear-gradient(135deg, #F4B342 0%, #360185 100%); flex-shrink: 0;">
                                    <i class="bi bi-people text-white fs-4"></i>
                                </div>
                                <div class="info-content">
                                    <small class="text-muted d-block">Capacity</small>
                                    <strong style="color: #360185;">{{ number_format($maxAttends) }} attendees</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- About Event -->
                    <div class="bg-white p-4 rounded-3 shadow-sm">
                        <h3 class="fw-bold mb-4" style="color: #360185;">About This Event</h3>
                        <p class="text-muted mb-4">{{ $event->description }}</p>

                        @if ($event->performers->count() > 0)
                            <h5 class="fw-bold mb-3" style="color: #360185;">Featured Performers</h5>
                            <div class="row g-3 mb-4">
                                @foreach ($event->performers as $performer)
                                    <div class="col-md-6">
                                        <div class="performer-item">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 50px; height: 50px; background: linear-gradient(135deg, #360185 0%, #8F0177 100%); color: white; font-weight: 600; flex-shrink: 0;">
                                                {{ substr($performer->name, 0, 2) }}
                                            </div>
                                            <div class="content">
                                                <strong style="color: #360185;">{{ $performer->name }}</strong>
                                                <small class="text-muted d-block">{{ $performer->genre }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if ($event->vendors->count() > 0)
                            <h5 class="fw-bold mb-3" style="color: #360185;">Event Vendors</h5>
                            <div class="row g-3">
                                @foreach ($event->vendors as $vendor)
                                    <div class="col-md-6">
                                        <div class="vendor-item">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                                style="width: 50px; height: 50px; background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%); color: white; font-weight: 600; flex-shrink: 0;">
                                                {{ substr($vendor->name, 0, 2) }}
                                            </div>
                                            <div class="content">
                                                <strong style="color: #360185;">{{ $vendor->name }}</strong>
                                                <small class="text-muted d-block">{{ $vendor->description }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar - Registration -->
                <div class="col-lg-4">
                    <div class="register-section">
                        <div class="register-card">
                            <h4 class="fw-bold mb-4" style="color: #360185;">Register for Event</h4>

                            <!-- Availability Status -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Availability</span>
                                    <span class="fw-bold" style="color: #360185;">{{ number_format($availableSlots) }} /
                                        {{ number_format($maxAttends) }} slots</span>
                                </div>
                                <div class="capacity-bar">
                                    <div class="capacity-fill" style="width: {{ $capacityPercentage }}%"></div>
                                </div>
                            </div>

                            <!-- Payment Section -->
                            @auth
                                @php
                                    $userRegistered = $event->registrations->where('user_id', Auth::id())->first();
                                @endphp

                                @if (!Auth::user()->hasVerifiedEmail())
                                    <div class="alert alert-warning\" role=\"alert\">
                                        <i class="bi
                                        bi-exclamation-triangle-fill me-2"></i>
                                        <strong>Email Verification Required</strong>
                                        <p class="mb-2 mt-2">Please verify your email address to register for events.</p>
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-envelope me-2"></i>Resend Verification Email
                                            </button>
                                        </form>
                                    </div>
                                @elseif($userRegistered)
                                    <div class="alert alert-success" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i>You're registered for this event!
                                        <div class="mt-2">
                                            <small class="d-block"><strong>Tickets:</strong>
                                                {{ $userRegistered->ticket_qty }}</small>
                                            <small class="d-block"><strong>Status:</strong>
                                                <span class="badge"
                                                    style="background-color: {{ $userRegistered->payment_status == 'paid' ? '#28a745' : '#ffc107' }};">
                                                    {{ ucfirst($userRegistered->payment_status) }}
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                @elseif($availableSlots <= 0)
                                    <button class="btn btn-lg w-100 disabled"
                                        style="background-color: #6c757d; color: white; font-weight: 600; border: none; border-radius: 10px;"
                                        disabled>
                                        <i class="bi bi-x-circle me-2"></i>Event Fully Booked
                                    </button>
                                @else
                                    <div class="mb-4">
                                        <div class="text-center p-3"
                                            style="background: linear-gradient(135deg, rgba(54, 1, 133, 0.05) 0%, rgba(143, 1, 119, 0.05) 100%); border-radius: 10px;">
                                            <small class="text-muted d-block">Price Per Ticket</small>
                                            <h2 class="fw-bold mb-0" style="color: #360185;">Rp 150,000</h2>
                                        </div>
                                    </div>

                                    <form action="{{ route('events.register', $event->id) }}" method="POST"
                                        id="registrationForm">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold" style="color: #360185;">
                                                <i class="bi bi-ticket-perforated me-2"></i>Number of Tickets
                                            </label>
                                            <input type="number" name="ticket_qty" id="ticketQty"
                                                class="form-control form-control-lg" min="1"
                                                max="{{ min($availableSlots, 10) }}" value="1" required
                                                style="border: 2px solid #360185; border-radius: 10px;"
                                                oninput="updateTotal()">
                                            <small class="text-muted">Maximum {{ min($availableSlots, 10) }} tickets per
                                                order</small>
                                        </div>

                                        <div class="mb-4 p-3" style="background-color: #f8f9fa; border-radius: 10px;">
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-muted">Ticket Quantity:</span>
                                                <span class="fw-bold" id="displayQty">1</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-muted">Price per Ticket:</span>
                                                <span class="fw-bold">Rp 150,000</span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-bold" style="color: #360185;">Total Amount:</span>
                                                <span class="fw-bold fs-5" style="color: #360185;" id="totalAmount">Rp
                                                    150,000</span>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-lg w-100 mb-3"
                                            style="background-color: #25D366; color: white; font-weight: 600; border: none; border-radius: 10px; transition: all 0.3s ease;"
                                            onmouseover="this.style.backgroundColor='#128C7E';"
                                            onmouseout="this.style.backgroundColor='#25D366';">
                                            <i class="bi bi-credit-card me-2"></i>Submit Payment Request
                                        </button>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <div class="mb-4">
                                    <div class="text-center p-3"
                                        style="background: linear-gradient(135deg, rgba(54, 1, 133, 0.05) 0%, rgba(143, 1, 119, 0.05) 100%); border-radius: 10px;">
                                        <small class="text-muted d-block">Price Per Ticket</small>
                                        <h2 class="fw-bold mb-0" style="color: #360185;">Rp 150,000</h2>
                                    </div>
                                </div>
                                <a href="{{ route('login') }}" class="btn btn-lg w-100"
                                    style="background-color: #F4B342; color: #360185; font-weight: 600; border: none; border-radius: 10px; transition: all 0.3s ease;"
                                    onmouseover="this.style.backgroundColor='#360185'; this.style.color='white';"
                                    onmouseout="this.style.backgroundColor='#F4B342'; this.style.color='#360185';">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login to Register
                                </a>
                            @endauth

                            <!-- Additional Info -->
                            <div class="mt-4 pt-4 border-top">
                                <small class="text-muted d-block mb-2">
                                    <i class="bi bi-shield-check me-2" style="color: #360185;"></i>Safe & Secure
                                    Registration
                                </small>
                                <small class="text-muted d-block mb-2">
                                    <i class="bi bi-envelope me-2" style="color: #360185;"></i>Email Confirmation Sent
                                </small>
                                <small class="text-muted d-block">
                                    <i class="bi bi-headset me-2" style="color: #360185;"></i>24/7 Customer Support
                                </small>
                            </div>
                        </div>

                        <!-- Share Event -->
                        <div class="bg-white p-4 rounded-3 shadow-sm mt-4">
                            <h5 class="fw-bold mb-3" style="color: #360185;">Share This Event</h5>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-primary flex-fill" style="border-radius: 10px;">
                                    <i class="bi bi-facebook"></i>
                                </button>
                                <button class="btn btn-outline-info flex-fill" style="border-radius: 10px;">
                                    <i class="bi bi-twitter"></i>
                                </button>
                                <button class="btn btn-outline-success flex-fill" style="border-radius: 10px;">
                                    <i class="bi bi-whatsapp"></i>
                                </button>
                                <button class="btn btn-outline-secondary flex-fill" style="border-radius: 10px;">
                                    <i class="bi bi-link-45deg"></i>
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
        // Update total amount calculation
        function updateTotal() {
            const qty = document.getElementById('ticketQty').value || 1;
            const pricePerTicket = 150000;
            const total = qty * pricePerTicket;

            document.getElementById('displayQty').textContent = qty;
            document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
@endpush
