@extends('layouts.app')

@section('title', 'My Bookings - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user-bookings.css') }}">
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
                            <div class="booking-card"
                                style="border-left: 5px solid 
                                @if ($booking->payment_status == 'paid') #55efc4
                                @elseif($booking->payment_status == 'rejected') #ff7675
                                @else #ffeaa7 @endif;">
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
                                                <div class="d-flex flex-column gap-2">
                                                    <button class="btn-view-ticket" disabled>
                                                        <i class="bi bi-file-earmark-pdf me-2"></i>
                                                        @if($booking->payment_status == 'pending')
                                                            Awaiting Approval
                                                        @else
                                                            Not Available
                                                        @endif
                                                    </button>
                                                    <a href="{{ route('events.show', $booking->event->id) }}" class="btn-view-ticket text-center">
                                                        <i class="bi bi-calendar-event me-2"></i>View Event
                                                    </a>
                                                </div>
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
