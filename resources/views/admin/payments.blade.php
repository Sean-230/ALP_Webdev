@extends('layouts.app')

@section('title', 'Payment Management - Admin')

@push('styles')
    <style>
        .admin-payments {
            padding: 120px 0 60px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .payment-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .payment-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
    <div class="admin-payments">
        <div class="container">
            <h1 class="mb-4 fw-bold" style="color: #360185;">
                <i class="bi bi-credit-card me-2"></i>Payment Management
            </h1>

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
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-clock-history"></i> Pending Payments</h5>
                            <h2>{{ $stats['pending'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-check-circle"></i> Approved Payments</h5>
                            <h2>{{ $stats['paid'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-receipt"></i> Total Registrations</h5>
                            <h2>{{ $stats['total'] }}</h2>
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
                                            {{ $payment->event->event_date->format('M d, Y') }}
                                        </small>
                                    </td>
                                    <td><span class="badge bg-info">{{ $payment->ticket_qty }} ticket(s)</span></td>
                                    <td>
                                        <strong style="color: #360185;">
                                            Rp {{ number_format($payment->ticket_qty * 150000, 0, ',', '.') }}
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
                                            <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" 
                                                    onclick="return confirm('Approve this payment?')">
                                                    <i class="bi bi-check-circle"></i> Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST" class="d-inline">
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
                        <p class="text-muted">All payment requests have been processed!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
