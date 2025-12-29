@extends('layouts.app')

@section('title', 'My Bookings - Festivo')

@push('styles')
    <style>
        .bookings-page {
            padding: 120px 0 60px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .booking-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .booking-card:hover {
            box-shadow: 0 5px 25px rgba(54, 1, 133, 0.15);
            transform: translateY(-3px);
        }

        .booking-header {
            background: linear-gradient(135deg, #360185 0%, #8F0177 100%);
            color: white;
            padding: 1.25rem;
        }

        .booking-body {
            padding: 1.5rem;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .ticket-info {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .ticket-info i {
            font-size: 2rem;
            color: #360185;
            margin-right: 1rem;
        }

        .btn-view-ticket {
            background: linear-gradient(135deg, #360185 0%, #8F0177 100%);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-view-ticket:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(54, 1, 133, 0.3);
            color: white;
        }

        .btn-view-ticket:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 1.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="bookings-page">
        <div class="container">
            <h1 class="mb-4 fw-bold" style="color: #360185;">
                <i class="bi bi-calendar-check me-2"></i>My Bookings
            </h1>

            @if($bookings->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h3 class="mb-3" style="color: #6c757d;">No Bookings Yet</h3>
                    <p class="text-muted mb-4">You haven't registered for any events yet. Start exploring events now!</p>
                    <a href="{{ route('explore') }}" class="btn-view-ticket">
                        <i class="bi bi-search me-2"></i>Explore Events
                    </a>
                </div>
            @else
                <div class="row">
                    <div class="col-12">
                        @foreach($bookings as $booking)
                            <div class="booking-card">
                                <div class="booking-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ $booking->event->name }}</h5>
                                            <small>
                                                <i class="bi bi-calendar-event me-1"></i>
                                                {{ \Carbon\Carbon::parse($booking->event->event_date)->format('F d, Y') }}
                                                <i class="bi bi-clock ms-3 me-1"></i>
                                                {{ \Carbon\Carbon::parse($booking->event->start_time)->format('g:i A') }}
                                            </small>
                                        </div>
                                        <span class="status-badge status-{{ $booking->payment_status }}">
                                            @if($booking->payment_status == 'pending')
                                                <i class="bi bi-hourglass-split me-1"></i>Pending
                                            @elseif($booking->payment_status == 'paid')
                                                <i class="bi bi-check-circle me-1"></i>Paid
                                            @else
                                                <i class="bi bi-x-circle me-1"></i>Rejected
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="booking-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="ticket-info">
                                                <i class="bi bi-ticket-perforated"></i>
                                                <div>
                                                    <div class="fw-bold">{{ $booking->ticket_qty }} Ticket(s)</div>
                                                    <small class="text-muted">Rp {{ number_format($booking->ticket_qty * 150000, 0, ',', '.') }}</small>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="bi bi-geo-alt text-muted me-2"></i>
                                                    <span>{{ $booking->event->location }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-bookmark text-muted me-2"></i>
                                                    <span>{{ $booking->event->category->name ?? 'General' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 d-flex flex-column justify-content-between align-items-end">
                                            <div class="text-end mb-3">
                                                <small class="text-muted d-block">Booking ID</small>
                                                <strong>#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</strong>
                                            </div>
                                            
                                            @if($booking->payment_status == 'paid')
                                                <button class="btn-view-ticket" onclick="viewTicket({{ $booking->id }})">
                                                    <i class="bi bi-file-earmark-pdf me-2"></i>View Ticket
                                                </button>
                                            @else
                                                <button class="btn-view-ticket" disabled>
                                                    <i class="bi bi-file-earmark-pdf me-2"></i>
                                                    @if($booking->payment_status == 'pending')
                                                        Awaiting Approval
                                                    @else
                                                        Not Available
                                                    @endif
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewTicket(bookingId) {
            window.open('/bookings/' + bookingId + '/ticket', '_blank');
        }
    </script>
@endpush
