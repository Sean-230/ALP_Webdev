@extends('layouts.app')

@section('title', 'Apply to Events - Festivo')

@push('styles')
    <style>
        .event-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(54, 1, 133, 0.15);
        }
        .event-status {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .status-upcoming {
            background-color: #d4edda;
            color: #155724;
        }
        .status-ongoing {
            background-color: #fff3cd;
            color: #856404;
        }
        .status-applied {
            background-color: #cce5ff;
            color: #004085;
        }
    </style>
@endpush

@section('content')
    <section class="py-5" style="background-color: #f0f0f5; margin-top: 70px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3" style="color: #360185;">Available Events</h1>
                    <p class="fs-5" style="color: #666;">Apply your vendor services to upcoming events</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="mb-4 p-3" style="background: white; border-radius: 10px; border-left: 4px solid #360185;">
                        <h5 style="color: #360185;">
                            <i class="bi bi-shop me-2"></i>Your Vendor: {{ $vendor->name }}
                        </h5>
                        <p class="text-muted mb-0">{{ $vendor->description }}</p>
                    </div>

                    @if ($events->count() > 0)
                        @foreach ($events as $event)
                            <div class="event-card">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex gap-2 mb-2">
                                            <span class="badge" style="background-color: #F4B342; color: #360185;">
                                                {{ $event->category->name }}
                                            </span>
                                            <span class="event-status status-{{ $event->status }}">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                            @if (in_array($event->id, $appliedEventIds))
                                                <span class="event-status status-applied">
                                                    <i class="bi bi-check-circle me-1"></i>Applied
                                                </span>
                                            @endif
                                        </div>

                                        <h4 class="fw-bold mb-2" style="color: #360185;">{{ $event->name }}</h4>
                                        <p class="text-muted mb-3">{{ Str::limit($event->description, 150) }}</p>

                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-calendar3 me-1" style="color: #8F0177;"></i>
                                                    {{ $event->event_date->format('F d, Y') }}
                                                </small>
                                            </div>
                                            <div class="col-sm-6">
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-geo-alt me-1" style="color: #DE1A58;"></i>
                                                    {{ $event->venue }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 d-flex align-items-center justify-content-end">
                                        @if (in_array($event->id, $appliedEventIds))
                                            <button class="btn btn-success w-100" disabled>
                                                <i class="bi bi-check-circle me-2"></i>Already Applied
                                            </button>
                                        @else
                                            <form action="{{ route('vendor.apply', $event->id) }}" method="POST" class="w-100">
                                                @csrf
                                                <button type="submit" class="btn w-100" 
                                                    style="background-color: #360185; color: white; border-radius: 10px;"
                                                    onmouseover="this.style.backgroundColor='#8F0177'"
                                                    onmouseout="this.style.backgroundColor='#360185'">
                                                    <i class="bi bi-plus-circle me-2"></i>Apply to Event
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x" style="font-size: 4rem; color: #ddd;"></i>
                            <h4 class="mt-3" style="color: #360185;">No Available Events</h4>
                            <p class="text-muted">There are currently no events accepting vendor applications.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
