@extends('layouts.app')

@section('title', 'Manage Events - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my-events.css') }}">
    <style>
        .manage-events-header {
            background-color: #f0f0f5;
            padding: 60px 0 40px;
            margin-top: 70px;
        }

        .nav-tabs {
            border-bottom: 3px solid #e9ecef;
            margin-bottom: 2rem;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            padding: 1rem 2rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-tabs .nav-link:hover {
            color: #360185;
            border: none;
        }

        .nav-tabs .nav-link.active {
            color: #360185;
            background: transparent;
            border: none;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #360185 0%, #8F0177 100%);
        }

        .tab-icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        .payment-stats {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .stat-item {
            text-align: center;
        }

        .stat-item h3 {
            color: #360185;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            color: #666;
            font-weight: 600;
            margin: 0;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }

        .badge-paid {
            background-color: #28a745;
            color: white;
        }
    </style>
@endpush

@section('content')
    <!-- Header Section -->
    <div class="manage-events-header">
        <div class="container">
            <div class="text-center">
                <h1 style="color: #360185; font-weight: 800; margin-bottom: 15px;">Manage Events</h1>
                <p style="color: #666; font-size: 1.1rem; margin-bottom: 0;">Manage your events and payment requests</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="manageEventsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="my-events-tab" data-bs-toggle="tab" data-bs-target="#my-events" 
                    type="button" role="tab" aria-controls="my-events" aria-selected="true">
                    <i class="bi bi-calendar-event tab-icon"></i>My Events
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="payment-requests-tab" data-bs-toggle="tab" data-bs-target="#payment-requests" 
                    type="button" role="tab" aria-controls="payment-requests" aria-selected="false">
                    <i class="bi bi-credit-card tab-icon"></i>Payment Requests
                    @if($paymentStats['pending'] > 0)
                        <span class="badge bg-danger ms-2">{{ $paymentStats['pending'] }}</span>
                    @endif
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="manageEventsTabContent">
            <!-- My Events Tab -->
            <div class="tab-pane fade show active" id="my-events" role="tabpanel" aria-labelledby="my-events-tab">
                <!-- Statistics Overview -->
                <div class="stats-overview">
                    <div class="row">
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="stat-box">
                                <h3>{{ $events->count() }}</h3>
                                <p>Total Events</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-3 mb-md-0">
                            <div class="stat-box">
                                <h3>{{ $events->where('status', 'upcoming')->count() }}</h3>
                                <p>Upcoming</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-box">
                                <h3>{{ $events->where('approval_status', 'approved')->count() }}</h3>
                                <p>Approved</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-box">
                                <h3>{{ $events->sum(function($event) { return $event->eventRegisters->count(); }) }}</h3>
                                <p>Total Registrations</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create Event Button -->
                <div class="mb-4 text-end">
                    <a href="{{ route('events.create') }}" class="btn btn-edit-event">
                        <i class="bi bi-plus-circle me-2"></i>Create New Event
                    </a>
                </div>

                <!-- Events List -->
                @if($events->isEmpty())
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <h4>No Events Created Yet</h4>
                        <p>Start creating amazing events for your audience!</p>
                        <a href="{{ route('events.create') }}" class="btn-edit-event">
                            <i class="bi bi-plus-circle me-2"></i>Create Your First Event
                        </a>
                    </div>
                @else
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-md-6 col-lg-4">
                                <div class="event-card" style="border-left: 5px solid 
                                    @if($event->approval_status == 'approved') #55efc4
                                    @elseif($event->approval_status == 'rejected') #ff7675
                                    @else #ffeaa7
                                    @endif;">
                                    <!-- Event Image -->
                                    @if($event->event_picture)
                                        <img src="{{ asset('images/events/' . $event->event_picture) }}" 
                                             alt="{{ $event->name }}" 
                                             class="img-fluid rounded mb-3"
                                             style="width: 100%; height: 200px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded mb-3 d-flex align-items-center justify-content-center"
                                             style="width: 100%; height: 200px;">
                                            <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                                        </div>
                                    @endif

                                    <!-- Event Name -->
                                    <h4 style="color: #360185; font-weight: 700; margin-bottom: 10px;">
                                        {{ Str::limit($event->name, 30) }}
                                    </h4>

                                    <!-- Status Badges -->
                                    <div class="mb-3">
                                        <span class="event-badge badge-{{ $event->status }}">
                                            @if($event->status == 'upcoming')
                                                <i class="bi bi-clock me-1"></i>
                                            @elseif($event->status == 'ongoing')
                                                <i class="bi bi-play-circle me-1"></i>
                                            @elseif($event->status == 'completed')
                                                <i class="bi bi-check-circle me-1"></i>
                                            @else
                                                <i class="bi bi-x-circle me-1"></i>
                                            @endif
                                            {{ ucfirst($event->status) }}
                                        </span>
                                        <span class="event-badge badge-{{ $event->approval_status }}">
                                            @if($event->approval_status == 'approved')
                                                <i class="bi bi-check-circle me-1"></i>
                                            @elseif($event->approval_status == 'pending')
                                                <i class="bi bi-hourglass-split me-1"></i>
                                            @else
                                                <i class="bi bi-x-circle me-1"></i>
                                            @endif
                                            {{ ucfirst($event->approval_status) }}
                                        </span>
                                    </div>

                                    <!-- Event Stats -->
                                    <div class="event-stats">
                                        <div class="stat-item">
                                            <div class="stat-icon icon-category">
                                                <i class="bi bi-tag"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Category</small>
                                                <p class="mb-0 fw-bold">{{ $event->category->name ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon icon-price">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Ticket Price</small>
                                                <p class="mb-0 fw-bold">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon icon-attendees">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Registrations</small>
                                                <p class="mb-0 fw-bold">{{ $event->eventRegisters->count() }} / {{ $event->max_attends }}</p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon icon-date">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Event Date</small>
                                                <p class="mb-0 fw-bold">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('event-manager.edit', $event->id) }}" class="btn-edit-event flex-fill text-center">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        <a href="{{ route('events.show', $event->id) }}" class="btn-view-event flex-fill text-center">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Payment Requests Tab -->
            <div class="tab-pane fade" id="payment-requests" role="tabpanel" aria-labelledby="payment-requests-tab">
                <!-- Payment Statistics -->
                <div class="payment-stats">
                    <div class="row">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="stat-item">
                                <i class="bi bi-clock-history" style="font-size: 2rem; color: #ffc107;"></i>
                                <h3>{{ $paymentStats['pending'] }}</h3>
                                <p>Pending Payments</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="stat-item">
                                <i class="bi bi-check-circle" style="font-size: 2rem; color: #28a745;"></i>
                                <h3>{{ $paymentStats['paid'] }}</h3>
                                <p>Approved Payments</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-item">
                                <i class="bi bi-receipt" style="font-size: 2rem; color: #360185;"></i>
                                <h3>{{ $paymentStats['total'] }}</h3>
                                <p>Total Registrations</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments Table -->
                <div class="card">
                    <div class="card-header" style="background-color: #360185; color: white;">
                        <h4 class="mb-0">
                            <i class="bi bi-hourglass-split me-2"></i>Pending Payment Requests
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($pendingPayments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Event</th>
                                        <th>Tickets</th>
                                        <th>Total Amount</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingPayments as $payment)
                                    <tr>
                                        <td><strong>#{{ $payment->id }}</strong></td>
                                        <td>
                                            <div>
                                                <strong>{{ $payment->user->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $payment->user->email }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>{{ $payment->event->name }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar-event"></i> 
                                                {{ \Carbon\Carbon::parse($payment->event->event_date)->format('M d, Y') }}
                                            </small>
                                        </td>
                                        <td><span class="badge bg-info">{{ $payment->ticket_qty }} ticket(s)</span></td>
                                        <td>
                                            <strong style="color: #360185;">
                                                Rp {{ number_format($payment->ticket_qty * $payment->event->price, 0, ',', '.') }}
                                            </strong>
                                        </td>
                                        <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <span class="badge badge-pending">
                                                <i class="bi bi-clock-history"></i> Pending
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <form action="{{ route('event-manager.payments.approve', $payment->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm" 
                                                        onclick="return confirm('Approve this payment?')">
                                                        <i class="bi bi-check-circle"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('event-manager.payments.reject', $payment->id) }}" method="POST" class="d-inline ms-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Reject this payment? This will delete the registration.')">
                                                        <i class="bi bi-x-circle"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $pendingPayments->links() }}
                        </div>
                        @else
                        <div class="text-center py-5">
                            <i class="bi bi-check-circle" style="font-size: 4rem; color: #28a745;"></i>
                            <h4 class="mt-3" style="color: #360185;">No Pending Payments</h4>
                            <p class="text-muted">All payment requests for your events have been processed!</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Preserve active tab on page reload without scrolling
    document.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash;
        if (hash === '#payment-requests') {
            const paymentTab = new bootstrap.Tab(document.getElementById('payment-requests-tab'));
            paymentTab.show();
        }
        
        // Scroll to top to prevent automatic scroll from hash
        window.scrollTo(0, 0);
    });

    // Update URL hash when tab changes without scrolling
    const tabButtons = document.querySelectorAll('button[data-bs-toggle="tab"]');
    tabButtons.forEach(button => {
        button.addEventListener('shown.bs.tab', function (event) {
            const target = event.target.getAttribute('data-bs-target');
            
            // Store current scroll position
            const scrollPos = window.scrollY;
            
            if (target === '#payment-requests') {
                window.location.hash = 'payment-requests';
            } else {
                // Remove hash without triggering scroll
                history.pushState("", document.title, window.location.pathname + window.location.search);
            }
            
            // Restore scroll position
            window.scrollTo(0, scrollPos);
        });
    });
</script>
@endpush
