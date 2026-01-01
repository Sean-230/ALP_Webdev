@extends('layouts.app')

@section('title', 'Payment Management - Event Manager')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/event-manager-payments.css') }}">
@endpush

@section('content')
    <div class="event-manager-payments">
        <div class="container">
            <h1 class="mb-4 fw-bold" style="color: #360185;">
                <i class="bi bi-credit-card me-2"></i>Payment Management
            </h1>
            <p class="text-muted mb-4">Manage payment requests for your events</p>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <i class="bi bi-clock-history" style="font-size: 2rem; color: #ffc107;"></i>
                        <h2>{{ $stats['pending'] }}</h2>
                        <h5>Pending Payments</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <i class="bi bi-check-circle" style="font-size: 2rem; color: #28a745;"></i>
                        <h2>{{ $stats['paid'] }}</h2>
                        <h5>Approved Payments</h5>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card">
                        <i class="bi bi-receipt" style="font-size: 2rem; color: #360185;"></i>
                        <h2>{{ $stats['total'] }}</h2>
                        <h5>Total Registrations</h5>
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
@endsection
