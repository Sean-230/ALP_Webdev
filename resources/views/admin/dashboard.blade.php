@extends('layouts.app')

@section('title', 'Admin Dashboard - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="admin-hero">
        <div class="pattern-dots"></div>
        <div class="container">
            <div class="text-center text-white">
                <div class="mb-3" style="animation: fadeInUp 0.6s ease-out;">
                    <span class="badge px-3 py-2" style="background-color: rgba(244, 179, 66, 0.2); color: #F4B342; font-size: 0.9rem; font-weight: 600; border: 1px solid rgba(244, 179, 66, 0.3);">
                        <i class="bi bi-shield-check me-2"></i>Administrator Portal
                    </span>
                </div>
                <h1 class="display-4 fw-bold mb-3" style="animation: fadeInUp 0.6s ease-out 0.1s backwards;">
                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                </h1>
                <p class="fs-5 opacity-90 mb-0" style="animation: fadeInUp 0.6s ease-out 0.2s backwards;">
                    Manage users, applications, events, and system settings
                </p>
            </div>
        </div>
    </section>

    <div class="admin-dashboard">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px; border-left: 4px solid #28a745;">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted mb-0 fw-semibold">Total Users</h6>
                            <div class="stat-icon-small" style="background: linear-gradient(135deg, #360185, #8F0177);">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold mb-0" style="color: #360185;">{{ number_format($stats['total_users']) }}</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted mb-0 fw-semibold">Event Managers</h6>
                            <div class="stat-icon-small" style="background: linear-gradient(135deg, #28a745, #20c997);">
                                <i class="bi bi-person-badge"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold mb-0" style="color: #28a745;">{{ number_format($stats['event_managers']) }}</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted mb-0 fw-semibold">Vendor Managers</h6>
                            <div class="stat-icon-small" style="background: linear-gradient(135deg, #17a2b8, #138496);">
                                <i class="bi bi-shop"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold mb-0" style="color: #17a2b8;">{{ number_format($stats['vendor_managers']) }}</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted mb-0 fw-semibold">Total Events</h6>
                            <div class="stat-icon-small" style="background: linear-gradient(135deg, #F4B342, #ffc107);">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold mb-0" style="color: #F4B342;">{{ number_format($stats['total_events']) }}</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted mb-0 fw-semibold">Pending Applications</h6>
                            <div class="stat-icon-small" style="background: linear-gradient(135deg, #8F0177, #DE1A58);">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold mb-0" style="color: #8F0177;">{{ number_format($stats['pending_applications']) }}</h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="text-muted mb-0 fw-semibold">Pending Events</h6>
                            <div class="stat-icon-small" style="background: linear-gradient(135deg, #dc3545, #c82333);">
                                <i class="bi bi-exclamation-circle"></i>
                            </div>
                        </div>
                        <h2 class="display-4 fw-bold mb-0" style="color: #dc3545;">{{ number_format($stats['pending_events']) }}</h2>
                    </div>
                </div>
            </div>

        <!-- Pending Manager Applications -->
        <div id="applications-section" class="card admin-card mb-4">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Pending Manager Applications</h4>
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
                            <tr class="application-item">
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
                
                @if($pendingApplications->hasPages())
                    <div class="d-flex justify-content-center align-items-center mt-4 gap-3">
                        @if ($pendingApplications->onFirstPage())
                            <button class="btn" disabled
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $pendingApplications->previousPageUrl() }}" class="btn applications-pagination-link"
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; display: flex; align-items: center;">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        @endif

                        <div class="d-flex gap-2 align-items-center">
                            @for ($i = 1; $i <= $pendingApplications->lastPage(); $i++)
                                <a href="{{ $pendingApplications->url($i) }}" class="applications-pagination-link"
                                    style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $i === $pendingApplications->currentPage() ? '#360185' : '#d0d0d0' }}; cursor: pointer; transition: all 0.3s ease; display: block; {{ $i === $pendingApplications->currentPage() ? 'transform: scale(1.2);' : '' }}"></a>
                            @endfor
                        </div>

                        @if ($pendingApplications->hasMorePages())
                            <a href="{{ $pendingApplications->nextPageUrl() }}" class="btn applications-pagination-link"
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; display: flex; align-items: center;">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        @else
                            <button class="btn" disabled
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                @endif
                @else
                <p class="text-muted mb-0">No pending applications</p>
                @endif
            </div>
        </div>

        <!-- Pending Events -->
        <div id="events-section" class="card admin-card mb-4">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Pending Event Approvals</h4>
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
                            <tr class="event-item">
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
                
                @if($pendingEvents->hasPages())
                    <div class="d-flex justify-content-center align-items-center mt-4 gap-3">
                        @if ($pendingEvents->onFirstPage())
                            <button class="btn" disabled
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $pendingEvents->previousPageUrl() }}" class="btn events-pagination-link"
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; display: flex; align-items: center;">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        @endif

                        <div class="d-flex gap-2 align-items-center">
                            @for ($i = 1; $i <= $pendingEvents->lastPage(); $i++)
                                <a href="{{ $pendingEvents->url($i) }}" class="events-pagination-link"
                                    style="width: 10px; height: 10px; border-radius: 50%; background-color: {{ $i === $pendingEvents->currentPage() ? '#360185' : '#d0d0d0' }}; cursor: pointer; transition: all 0.3s ease; display: block; {{ $i === $pendingEvents->currentPage() ? 'transform: scale(1.2);' : '' }}"></a>
                            @endfor
                        </div>

                        @if ($pendingEvents->hasMorePages())
                            <a href="{{ $pendingEvents->nextPageUrl() }}" class="btn events-pagination-link"
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; display: flex; align-items: center;">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        @else
                            <button class="btn" disabled
                                style="background: none; border: none; color: #6c757d; font-size: 1.2rem; padding: 0; line-height: 1; opacity: 0.3; cursor: not-allowed; display: flex; align-items: center;">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        @endif
                    </div>
                @endif
                @else
                <p class="text-muted mb-0">No pending events</p>
                @endif
            </div>
        </div>
        </div>
    </div>

    <script>
        // Execute immediately to prevent scroll to top
        (function() {
            const savedScroll = sessionStorage.getItem('savedScroll');
            const scrollToApplications = sessionStorage.getItem('scrollToApplications');
            const scrollToEvents = sessionStorage.getItem('scrollToEvents');
            
            if ((scrollToApplications === 'true' || scrollToEvents === 'true') && savedScroll) {
                history.scrollRestoration = 'manual';
                // Restore position immediately
                document.documentElement.scrollTop = document.body.scrollTop = parseInt(savedScroll);
            }
        })();

        document.addEventListener('DOMContentLoaded', function() {
            // Applications pagination scroll
            const applicationsLinks = document.querySelectorAll('.applications-pagination-link');
            applicationsLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                    sessionStorage.setItem('scrollToApplications', 'true');
                    sessionStorage.setItem('savedScroll', currentScroll);
                });
            });

            // Events pagination scroll
            const eventsLinks = document.querySelectorAll('.events-pagination-link');
            eventsLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
                    sessionStorage.setItem('scrollToEvents', 'true');
                    sessionStorage.setItem('savedScroll', currentScroll);
                });
            });

            // Scroll to applications section after page load
            if (sessionStorage.getItem('scrollToApplications') === 'true') {
                sessionStorage.removeItem('scrollToApplications');
                sessionStorage.removeItem('savedScroll');
                const applicationsSection = document.getElementById('applications-section');
                if (applicationsSection) {
                    setTimeout(() => {
                        applicationsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                }
            }

            // Scroll to events section after page load
            if (sessionStorage.getItem('scrollToEvents') === 'true') {
                sessionStorage.removeItem('scrollToEvents');
                sessionStorage.removeItem('savedScroll');
                const eventsSection = document.getElementById('events-section');
                if (eventsSection) {
                    setTimeout(() => {
                        eventsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                }
            }
        });
    </script>
@endsection
