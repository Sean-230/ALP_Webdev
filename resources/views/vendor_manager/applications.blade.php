@extends('layouts.app')

@section('title', 'My Applications - Festivo')

@push('styles')
    <style>
        .application-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
    </style>
@endpush

@section('content')
    <section class="py-5" style="background-color: #f0f0f5; margin-top: 70px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3" style="color: #360185;">My Applications</h1>
                    <p class="fs-5" style="color: #666;">Track your vendor applications to events</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    <div class="mb-4 p-3" style="background: white; border-radius: 10px; border-left: 4px solid #360185;">
                        <h5 style="color: #360185;">
                            <i class="bi bi-shop me-2"></i>Your Vendor: {{ $vendor->name }}
                        </h5>
                        <p class="text-muted mb-0">{{ $vendor->description }}</p>
                    </div>

                    @if ($appliedEvents->count() > 0)
                        <div class="mb-3">
                            <h5 style="color: #360185;">
                                <i class="bi bi-list-check me-2"></i>
                                Applied to {{ $appliedEvents->count() }} {{ Str::plural('event', $appliedEvents->count()) }}
                            </h5>
                        </div>

                        @foreach ($appliedEvents as $event)
                            <div class="application-card">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="d-flex gap-2 mb-2">
                                            <span class="badge" style="background-color: #F4B342; color: #360185;">
                                                {{ $event->category->name }}
                                            </span>
                                            <span class="badge" style="background-color: #28a745; color: white;">
                                                <i class="bi bi-check-circle me-1"></i>Applied
                                            </span>
                                        </div>

                                        <h4 class="fw-bold mb-2" style="color: #360185;">{{ $event->name }}</h4>
                                        <p class="text-muted mb-3">{{ Str::limit($event->description, 120) }}</p>

                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-calendar3 me-1" style="color: #8F0177;"></i>
                                                    {{ $event->event_date->format('F d, Y - g:i A') }}
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

                                    <div class="col-md-3 d-flex align-items-center justify-content-end">
                                        <a href="{{ route('events.show', $event->id) }}" 
                                            class="btn btn-outline-primary w-100"
                                            style="border-radius: 10px; border-color: #360185; color: #360185;">
                                            <i class="bi bi-eye me-2"></i>View Event
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #ddd;"></i>
                            <h4 class="mt-3" style="color: #360185;">No Applications Yet</h4>
                            <p class="text-muted mb-4">You haven't applied to any events yet.</p>
                            <a href="{{ route('vendor.events') }}" class="btn btn-lg" 
                                style="background-color: #360185; color: white; border-radius: 10px;">
                                <i class="bi bi-search me-2"></i>Browse Available Events
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
