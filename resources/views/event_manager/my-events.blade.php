@extends('layouts.app')

@section('title', 'My Events - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/event-manager-my-events.css') }}">
@endpush

@section('content')
    <!-- Header Section -->
    <div class="events-header">
        <div class="container">
            <div class="text-center">
                <h1 style="color: #360185; font-weight: 800; margin-bottom: 15px;">My Events</h1>
                <p style="color: #666; font-size: 1.1rem; margin-bottom: 0;">Manage and track all your created events</p>
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
@endsection
