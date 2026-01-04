@extends('layouts.app')

@section('title', 'Manage Events - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/event-manager-my-events.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event-manager-manage-events.css') }}">
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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
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
                    @if ($paymentStats['pending'] > 0)
                        <span class="badge bg-danger ms-2">{{ $paymentStats['pending'] }}</span>
                    @endif
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="qna-tab" data-bs-toggle="tab" data-bs-target="#qna"
                    type="button" role="tab" aria-controls="qna" aria-selected="false">
                    <i class="bi bi-chat-left-text tab-icon"></i>Q&A
                    @if ($unansweredQnaCount > 0)
                        <span class="badge bg-warning ms-2">{{ $unansweredQnaCount }}</span>
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
                                <h3>{{ $events->sum(function ($event) {return $event->eventRegisters->count();}) }}</h3>
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
                @if ($events->isEmpty())
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
                        @foreach ($events as $event)
                            <div class="col-md-6 col-lg-4">
                                <div class="event-card"
                                    style="border-left: 5px solid 
                                    @if ($event->approval_status == 'approved') #55efc4
                                    @elseif($event->approval_status == 'rejected') #ff7675
                                    @else #ffeaa7 @endif;">
                                    <!-- Event Name -->
                                    <h4 style="color: #360185; font-weight: 700; margin-bottom: 10px;">
                                        {{ Str::limit($event->name, 30) }}
                                    </h4>

                                    <!-- Status Badges -->
                                    <div class="mb-3">
                                        <span class="event-badge badge-{{ $event->status }}">
                                            @if ($event->status == 'upcoming')
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
                                            @if ($event->approval_status == 'approved')
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
                                                <p class="mb-0 fw-bold">Rp {{ number_format($event->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon icon-attendees">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Registrations</small>
                                                <p class="mb-0 fw-bold">{{ $event->eventRegisters->whereIn('payment_status', ['pending', 'paid'])->sum('ticket_qty') }} /
                                                    {{ $event->max_attends }}</p>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon icon-date">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted">Event Date</small>
                                                <p class="mb-0 fw-bold">
                                                    {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('event-manager.edit', $event->id) }}"
                                            class="btn-edit-event flex-fill text-center">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        <a href="{{ route('events.show', $event->id) }}"
                                            class="btn-view-event flex-fill text-center">
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
                        @if ($pendingPayments->count() > 0)
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
                                        @foreach ($pendingPayments as $payment)
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
                                                <td><span class="badge bg-info">{{ $payment->ticket_qty }}
                                                        ticket(s)</span></td>
                                                <td>
                                                    <strong style="color: #360185;">
                                                        Rp
                                                        {{ number_format($payment->ticket_qty * $payment->event->price, 0, ',', '.') }}
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
                                                        <form
                                                            action="{{ route('event-manager.payments.approve', $payment->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                onclick="return confirm('Approve this payment?')">
                                                                <i class="bi bi-check-circle"></i> Approve
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('event-manager.payments.reject', $payment->id) }}"
                                                            method="POST" class="d-inline ms-1">
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

                <!-- Q&A Tab -->
                <div class="tab-pane fade" id="qna" role="tabpanel" aria-labelledby="qna-tab">
                    <h1 style="color: red; padding: 30px; font-size: 2rem;">TEST - Q&A TAB IS LOADING</h1>
                    
                    <div class="p-4">
                        <h2>Debug: {{ isset($allQnas) ? $allQnas->count() : 'NOT SET' }} questions found</h2>
                        
                        @if(isset($allQnas) && $allQnas->count() > 0)
                            @foreach($allQnas as $qna)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <div class="mb-3 pb-3 border-bottom">
                                            <span class="badge bg-primary">
                                                <i class="bi bi-calendar-event me-1"></i>{{ $qna->event->name }}
                                            </span>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <strong style="color: #360185;">{{ $qna->user->name }}</strong>
                                            <p class="mt-2">{{ $qna->question }}</p>
                                        </div>
                                        
                                        @if($qna->answer)
                                            <div class="p-3 bg-light rounded">
                                                <strong>Your Answer:</strong>
                                                <p class="mb-0">{{ $qna->answer }}</p>
                                            </div>
                                        @else
                                            <form action="{{ route('events.qna.answer', $qna->id) }}" method="POST">
                                                @csrf
                                                <textarea name="answer" class="form-control mb-2" rows="3" required></textarea>
                                                <button type="submit" class="btn btn-primary">Submit Answer</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                No Q&A found. Total: {{ isset($allQnas) ? $allQnas->count() : '0' }}
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
            } else if (hash === '#qna') {
                const qnaTab = new bootstrap.Tab(document.getElementById('qna-tab'));
                qnaTab.show();
            }
        });

        // Update URL hash when tab changes without scrolling
        const tabButtons = document.querySelectorAll('button[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('shown.bs.tab', function(event) {
                const target = event.target.getAttribute('data-bs-target');

                if (target === '#payment-requests') {
                    history.replaceState(null, null, '#payment-requests');
                } else if (target === '#qna') {
                    history.replaceState(null, null, '#qna');
                } else {
                    history.replaceState(null, null, window.location.pathname + window.location.search);
                }
            });
        });
    </script>
@endpush
