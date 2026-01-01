@extends('layouts.app')

@section('title', 'Admin Dashboard - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@section('content')
    <div class="admin-dashboard">
        <div class="container">
            <h1 class="mb-4 fw-bold" style="color: #360185;">
                <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
            </h1>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-people-fill"></i> Total Users</h5>
                            <h2>{{ $stats['total_users'] }}</h2>
                        </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-person-badge"></i> Event Managers</h5>
                        <h2>{{ $stats['event_managers'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white" style="background-color: #17a2b8;">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-shop"></i> Vendor Managers</h5>
                        <h2>{{ $stats['vendor_managers'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-calendar-event"></i> Total Events</h5>
                        <h2>{{ $stats['total_events'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-clock-history"></i> Pending Applications</h5>
                        <h2>{{ $stats['pending_applications'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-exclamation-circle"></i> Pending Events</h5>
                        <h2>{{ $stats['pending_events'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Manager Applications -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill"></i> Pending Manager Applications</h4>
            </div>
            <div class="card-body">
                @if($pendingApplications->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Email</th>
                                <th>Role Type</th>
                                <th>Applied Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingApplications as $application)
                            <tr>
                                <td>{{ $application->user->name }}</td>
                                <td>{{ $application->user->email }}</td>
                                <td>
                                    @if($application->role_type === 'event_manager')
                                        <span class="badge bg-primary"><i class="bi bi-calendar-event me-1"></i>Event Manager</span>
                                    @else
                                        <span class="badge bg-success"><i class="bi bi-shop me-1"></i>Vendor Manager</span>
                                    @endif
                                </td>
                                <td>{{ $application->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <form action="{{ route('admin.applications.approve', $application->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $application->id }}">
                                        <i class="bi bi-x-circle"></i> Reject
                                    </button>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $application->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.applications.reject', $application->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reject Application</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to reject {{ $application->user->name }}'s application?</p>
                                                        <div class="mb-3">
                                                            <label for="reason" class="form-label">Reason (optional)</label>
                                                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Enter reason for rejection"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Reject Application</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted mb-0">No pending applications</p>
                @endif
            </div>
        </div>

        <!-- Pending Events -->
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0"><i class="bi bi-calendar-check"></i> Pending Event Approvals</h4>
            </div>
            <div class="card-body">
                @if($pendingEvents->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingEvents as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->category->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.events.reject', $event->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject this event?')">
                                            <i class="bi bi-x-circle"></i> Reject
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted mb-0">No pending events</p>
                @endif
            </div>
        </div>
        </div>
    </div>
@endsection
