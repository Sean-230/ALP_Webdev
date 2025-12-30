@extends('layouts.app')

@section('title', 'Create Event - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create-event.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="py-5" style="background-color: #f0f0f5; margin-top: 70px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto text-center">
                    <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                        <ol class="breadcrumb mb-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none"
                                    style="color: #360185;">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #666;">Create Event</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3" style="color: #360185;">Create Your Event</h1>
                    <p class="fs-5" style="color: #666;">Fill in the details below to create an amazing event experience
                        for your
                        attendees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Create Event Form Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-10 mx-auto">

                    <!-- Info Alert -->
                    <div class="alert-info-custom">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-info-circle-fill me-3"></i>
                            <div>
                                <h5>Important Information</h5>
                                <p class="mb-2"><i class="bi bi-check-circle me-2"></i>All events require admin approval
                                    before going live</p>
                                <p class="mb-2"><i class="bi bi-check-circle me-2"></i>Make sure all information is
                                    accurate
                                    and complete</p>
                                <p class="mb-0"><i class="bi bi-check-circle me-2"></i>You can manage your events after
                                    creation</p>
                            </div>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h6 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the
                                following errors:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Basic Information -->
                        <div class="form-card">
                            <h3 class="form-section-title">
                                <i class="bi bi-info-circle-fill"></i>
                                Basic Information
                            </h3>

                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label for="event_name" class="form-label">
                                        <i class="bi bi-calendar-event"></i>
                                        Event Name
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="event_name" name="name"
                                        value="{{ old('name') }}" required placeholder="Enter event name">
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Choose a catchy and descriptive name for your event
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">
                                        <i class="bi bi-tag"></i>
                                        Event Category
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">
                                        <i class="bi bi-currency-dollar"></i>
                                        Price Per Ticket (Rp)
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price', 150000) }}" required min="0" step="1000"
                                        placeholder="150000">
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Set the ticket price in Indonesian Rupiah
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="description" class="form-label">
                                        <i class="bi bi-text-paragraph"></i>
                                        Event Description
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <textarea class="form-control" id="description" name="description" required rows="5"
                                        placeholder="Describe your event in detail...">{{ old('description') }}</textarea>
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Provide a detailed description to attract more attendees
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="event_picture" class="form-label">
                                        <i class="bi bi-image"></i>
                                        Event Image
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="file" class="form-control" id="event_picture" name="event_picture"
                                        accept=".jpg,.jpeg,.png" required onchange="validateImage(this)">
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Upload a high-quality image (JPG/PNG only, max 2MB)
                                    </small>
                                    <div id="imagePreview" class="mt-3" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview"
                                            style="max-width: 300px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date, Time & Location -->
                        <div class="form-card">
                            <h3 class="form-section-title">
                                <i class="bi bi-geo-alt-fill"></i>
                                Date, Time & Location
                            </h3>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="event_date" class="form-label">
                                        <i class="bi bi-calendar3"></i>
                                        Event Date & Time
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="datetime-local" class="form-control" id="event_date" name="event_date"
                                        value="{{ old('event_date') }}" required
                                        min="{{ now()->addDay()->format('Y-m-d\TH:i') }}">
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Event must be scheduled at least 24 hours in advance
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label for="venue" class="form-label">
                                        <i class="bi bi-pin-map"></i>
                                        Venue/Location
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="venue" name="venue"
                                        value="{{ old('venue') }}" required
                                        placeholder="e.g., Jakarta Convention Center">
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Specify the exact venue or location
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label for="capacity" class="form-label">
                                        <i class="bi bi-people"></i>
                                        Event Capacity
                                        <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="capacity" name="capacity"
                                        value="{{ old('capacity', 100) }}" required min="10" step="10"
                                        placeholder="100">
                                    <small class="info-text">
                                        <i class="bi bi-lightbulb"></i>
                                        Maximum number of attendees
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Performers -->
                        <div class="form-card">
                            <h3 class="form-section-title">
                                <i class="bi bi-star-fill"></i>
                                Featured Performers
                            </h3>

                            <p class="text-muted mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                Add performers who will be featured at your event. You can add up to 5 performers.
                            </p>

                            <div id="performersContainer">
                                <div class="row g-3 performer-row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="bi bi-person"></i>
                                            Performer Name
                                        </label>
                                        <input type="text" class="form-control" name="performer_names[]"
                                            placeholder="Enter performer name" value="{{ old('performer_names.0') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="bi bi-music-note"></i>
                                            Genre/Type
                                        </label>
                                        <input type="text" class="form-control" name="performer_genres[]"
                                            placeholder="e.g., Rock Band, DJ, Singer"
                                            value="{{ old('performer_genres.0') }}">
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPerformer()"
                                id="addPerformerBtn">
                                <i class="bi bi-plus-circle me-1"></i>Add Another Performer
                            </button>
                        </div>

                        <!-- Event Vendors -->
                        <div class="form-card">
                            <h3 class="form-section-title">
                                <i class="bi bi-shop"></i>
                                Event Vendors
                            </h3>

                            <p class="text-muted mb-4">
                                <i class="bi bi-info-circle me-2"></i>
                                Select vendors who will provide services at your event (optional)
                            </p>

                            @if ($vendors->count() > 0)
                                <div class="multi-select-container">
                                    @foreach ($vendors as $vendor)
                                        <div class="multi-select-item">
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" name="vendors[]" value="{{ $vendor->id }}"
                                                    id="vendor_{{ $vendor->id }}"
                                                    {{ in_array($vendor->id, old('vendors', [])) ? 'checked' : '' }}>
                                                <div class="item-info">
                                                    <h6 class="mb-0">{{ $vendor->name }}</h6>
                                                    <small class="text-muted">{{ $vendor->description }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-shop-window"></i>
                                    <p>No vendors available at the moment</p>
                                </div>
                            @endif
                        </div>

                        <!-- Form Actions -->
                        <div class="form-card">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-create-event w-100">
                                        <i class="bi bi-calendar-check me-2"></i>
                                        Create Event
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

                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let performerCount = 1;
        const maxPerformers = 5;

        // Add new performer input fields
        function addPerformer() {
            if (performerCount >= maxPerformers) {
                alert('Maximum 5 performers allowed');
                document.getElementById('addPerformerBtn').disabled = true;
                return;
            }

            performerCount++;
            const container = document.getElementById('performersContainer');
            const newRow = document.createElement('div');
            newRow.className = 'row g-3 performer-row mb-3';
            newRow.innerHTML = `
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-person"></i>
                        Performer Name
                    </label>
                    <input type="text" class="form-control" name="performer_names[]" 
                        placeholder="Enter performer name">
                </div>
                <div class="col-md-5">
                    <label class="form-label">
                        <i class="bi bi-music-note"></i>
                        Genre/Type
                    </label>
                    <input type="text" class="form-control" name="performer_genres[]" 
                        placeholder="e.g., Rock Band, DJ, Singer">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-danger w-100" onclick="removePerformer(this)" title="Remove">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(newRow);

            if (performerCount >= maxPerformers) {
                document.getElementById('addPerformerBtn').disabled = true;
            }
        }

        // Remove performer row
        function removePerformer(button) {
            button.closest('.performer-row').remove();
            performerCount--;
            if (performerCount < maxPerformers) {
                document.getElementById('addPerformerBtn').disabled = false;
            }
        }

        // Validate image upload
        function validateImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');

            if (file) {
                // Check file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload only JPG or PNG images');
                    input.value = '';
                    preview.style.display = 'none';
                    return false;
                }

                // Check file size (2MB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert('Image size must be less than 2MB');
                    input.value = '';
                    preview.style.display = 'none';
                    return false;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Form validation feedback
        (function() {
            'use strict'
            const forms = document.querySelectorAll('form')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        // Auto-dismiss alerts after 5 seconds
        window.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
@endpush
