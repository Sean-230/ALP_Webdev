@extends('layouts.app')

@section('title', 'Vendor Profile - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/event-manager-create-event.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="py-5" style="background-color: #f0f0f5; margin-top: 70px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <h1 class="display-4 fw-bold mb-3" style="color: #360185;">Vendor Profile</h1>
                    <p class="fs-5" style="color: #666;">Set up your F&B vendor information to get selected by event organizers</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-8 mx-auto">

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

                    @if ($vendor && $vendor->events()->count() > 0)
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            <strong>Note:</strong> You have already applied to events. You cannot edit your vendor
                            information after applying.
                        </div>
                    @endif

                    <form action="{{ route('vendor.profile.store') }}" method="POST">
                        @csrf

                        <div class="form-card" style="border-left: 5px solid #8F0177;">
                            <h3 class="form-section-title">
                                <i class="bi bi-shop"></i>
                                Vendor Information
                            </h3>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">
                                        <i class="bi bi-tag"></i>
                                        Vendor Name (F&B)
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $vendor->name ?? '') }}" required
                                        placeholder="e.g., Joe's Coffee Stand"
                                        {{ $vendor && $vendor->events()->count() > 0 ? 'readonly' : '' }}>
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Enter your food & beverage business name
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="description" class="form-label">
                                        <i class="bi bi-text-paragraph"></i>
                                        Description
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <textarea class="form-control" id="description" name="description" required rows="5"
                                        placeholder="Describe your F&B services, menu, specialties..."
                                        {{ $vendor && $vendor->events()->count() > 0 ? 'readonly' : '' }}>{{ old('description', $vendor->description ?? '') }}</textarea>
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Provide details about your offerings to attract event organizers
                                    </small>
                                </div>
                            </div>
                        </div>

                        @if (!$vendor || $vendor->events()->count() == 0)
                            <div class="form-card">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-create-event w-100">
                                            <i class="bi bi-check-circle me-2"></i>
                                            Save Vendor Profile
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('home') }}" class="btn btn-cancel w-100">
                                            <i class="bi bi-x-circle me-2"></i>
                                            Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </form>

                    @if ($vendor)
                        <div class="form-card mt-4"
                            style="background: linear-gradient(135deg, rgba(54, 1, 133, 0.05) 0%, rgba(143, 1, 119, 0.05) 100%); border-left: 5px solid #8F0177;">
                            <div class="text-center mb-4">
                                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #8F0177;"></i>
                                <h4 class="mt-3" style="color: #360185; font-weight: 700;">Profile Complete!</h4>
                                <p class="text-muted">Your vendor profile is live. Event managers can now discover and
                                    select you for their events.</p>
                            </div>
                            <div class="d-grid">
                                <a href="{{ route('vendor.applications') }}" class="btn btn-lg"
                                    style="background: linear-gradient(135deg, #360185 0%, #8F0177 100%); color: white; border-radius: 12px; padding: 15px; font-weight: 600; transition: all 0.3s ease;"
                                    onmouseover="this.style.background='linear-gradient(135deg, #8F0177 0%, #DE1A58 100%)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(143, 1, 119, 0.4)';"
                                    onmouseout="this.style.background='linear-gradient(135deg, #360185 0%, #8F0177 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                                    <i class="bi bi-list-check me-2"></i>View My Applications
                                </a>
                            </div>
                            <div class="mt-3 text-center">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Event managers will reach out to you if they want your services
                                </small>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
