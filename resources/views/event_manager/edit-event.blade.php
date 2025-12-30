@extends('layouts.app')

@section('title', 'Edit Event - Festivo')

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
                            <li class="breadcrumb-item"><a href="{{ route('event-manager.my-events') }}"
                                    class="text-decoration-none" style="color: #360185;">My Events</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #666;">Edit Event</li>
                        </ol>
                    </nav>
                    <h1 class="display-4 fw-bold mb-3" style="color: #360185;">Edit Your Event</h1>
                    <p class="fs-5" style="color: #666;">Update the details below to keep your event information current.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Event Form Section -->
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
                                <p class="mb-2"><i class="bi bi-check-circle me-2"></i>Changes may require admin approval
                                </p>
                                <p class="mb-2"><i class="bi bi-check-circle me-2"></i>Current registrations:
                                    {{ $event->eventRegisters->count() }}</p>
                                <p class="mb-0"><i class="bi bi-check-circle me-2"></i>Cannot reduce capacity below
                                    current registrations</p>
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

                    <!-- Form Card -->
                    <div class="form-card">

                        <form action="{{ route('event-manager.update', $event->id) }}" method="POST"
                            enctype="multipart/form-data" id="editEventForm">
                            @csrf
                            @method('PUT')

                            <!-- Basic Information -->
                            <div class="form-section">
                                <h3 class="form-section-title">
                                    <i class="bi bi-info-circle"></i> Basic Information
                                </h3>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Event Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $event->name) }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="category_id" class="form-label">Category <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description', $event->description) }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="event_date" class="form-label">Event Date <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="event_date" name="event_date"
                                            value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="venue" class="form-label">Venue/Location <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="venue" name="venue"
                                            value="{{ old('venue', $event->venue) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing & Capacity -->
                            <div class="form-section">
                                <h3 class="form-section-title">
                                    <i class="bi bi-currency-dollar"></i> Pricing & Capacity
                                </h3>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="price" class="form-label">Ticket Price (Rp) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            value="{{ old('price', $event->price) }}" min="0" step="1000"
                                            required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="max_attends" class="form-label">Maximum Attendees <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="max_attends" name="max_attends"
                                            value="{{ old('max_attends', $event->max_attends) }}" min="1"
                                            required>
                                        <small class="text-muted">Current registrations:
                                            {{ $event->eventRegisters->count() }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Event Image -->
                            <div class="form-section">
                                <h3 class="form-section-title">
                                    <i class="bi bi-image"></i> Event Image
                                </h3>

                                @if ($event->event_picture)
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div class="position-relative" style="max-width: 300px;">
                                            <img src="{{ asset('images/events/' . $event->event_picture) }}"
                                                alt="Current event image" class="img-fluid rounded" id="currentImage">
                                        </div>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label for="event_picture" class="form-label">
                                        {{ $event->event_picture ? 'Change Image' : 'Upload Image' }}
                                    </label>
                                    <input type="file" class="form-control" id="event_picture" name="event_picture"
                                        accept="image/png, image/jpeg, image/jpg">
                                    <small class="text-muted">Accepted formats: PNG, JPG, JPEG (Max: 2MB)</small>
                                </div>

                                <div id="imagePreviewContainer" style="display: none;">
                                    <label class="form-label">New Image Preview</label>
                                    <div class="position-relative" style="max-width: 300px;">
                                        <img id="imagePreview" src="" alt="Preview" class="img-fluid rounded">
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                                            onclick="removeImage()">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Performers -->
                            <div class="form-section">
                                <h3 class="form-section-title">
                                    <i class="bi bi-mic"></i> Featured Performers
                                </h3>
                                <p class="text-muted mb-3">Add up to 5 performers for your event</p>

                                <div id="performersContainer">
                                    @php
                                        $existingPerformers = old(
                                            'performers',
                                            $event->eventPerformers
                                                ->map(function ($ep) {
                                                    return [
                                                        'name' => $ep->performer->name ?? '',
                                                        'genre' => $ep->performer->genre ?? '',
                                                    ];
                                                })
                                                ->toArray(),
                                        );
                                    @endphp

                                    @forelse($existingPerformers as $index => $performer)
                                        <div class="performer-row mb-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control"
                                                        name="performers[{{ $index }}][name]"
                                                        placeholder="Performer Name"
                                                        value="{{ $performer['name'] ?? '' }}">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger w-100"
                                                        onclick="removePerformer(this)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="performer-row mb-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="performers[0][name]"
                                                        placeholder="Performer Name">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-danger w-100"
                                                        onclick="removePerformer(this)">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                <button type="button" class="btn btn-outline-primary mb-4" onclick="addPerformer()"
                                    id="addPerformerBtn">
                                    <i class="bi bi-plus-circle"></i> Add Performer
                                </button>
                            </div>

                            <!-- Vendors -->
                            <div class="form-section">
                                <h3 class="form-section-title">
                                    <i class="bi bi-shop"></i> Partner Vendors
                                </h3>
                                <p class="text-muted mb-3">Select vendors who will participate in your event</p>

                                @if ($vendors->isEmpty())
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle me-2"></i>
                                        No approved vendors available at the moment.
                                    </div>
                                @else
                                    <div class="row">
                                        @foreach ($vendors as $vendor)
                                            <div class="col-md-6 mb-3">
                                                <div class="form-check vendor-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="vendors[]"
                                                        value="{{ $vendor->id }}" id="vendor{{ $vendor->id }}"
                                                        {{ in_array($vendor->id, old('vendors', $event->eventVendors->pluck('vendor_id')->toArray())) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="vendor{{ $vendor->id }}">
                                                        <strong>{{ $vendor->name }}</strong>
                                                        <br><small class="text-muted">{{ $vendor->description }}</small>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Submit Buttons -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-create-event w-100">
                                        <i class="bi bi-check-circle me-2"></i>
                                        Update Event
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('event-manager.my-events') }}" class="btn btn-cancel w-100">
                                        <i class="bi bi-x-circle me-2"></i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let performerCount = {{ count($existingPerformers) > 0 ? count($existingPerformers) : 1 }};

        // Image Preview
        document.getElementById('event_picture').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Please upload only PNG, JPG, or JPEG images.');
                    this.value = '';
                    return;
                }

                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB.');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                    if (document.getElementById('currentImage')) {
                        document.getElementById('currentImage').style.opacity = '0.5';
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        function removeImage() {
            document.getElementById('event_picture').value = '';
            document.getElementById('imagePreviewContainer').style.display = 'none';
            if (document.getElementById('currentImage')) {
                document.getElementById('currentImage').style.opacity = '1';
            }
        }

        // Performer Management
        function addPerformer() {
            if (performerCount >= 5) {
                alert('Maximum 5 performers allowed');
                return;
            }

            const container = document.getElementById('performersContainer');
            const newRow = document.createElement('div');
            newRow.className = 'performer-row mb-3';
            newRow.innerHTML = `
                <div class="row align-items-center">
                    <div class="col-md-10">
                        <input type="text" class="form-control" 
                               name="performers[${performerCount}][name]" 
                               placeholder="Performer Name">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger w-100" onclick="removePerformer(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newRow);
            performerCount++;

            if (performerCount >= 5) {
                document.getElementById('addPerformerBtn').disabled = true;
            }
        }

        function removePerformer(button) {
            const row = button.closest('.performer-row');
            row.remove();
            performerCount--;

            if (performerCount < 5) {
                document.getElementById('addPerformerBtn').disabled = false;
            }

            // Reindex performers
            const performers = document.querySelectorAll('.performer-row');
            performers.forEach((row, index) => {
                row.querySelectorAll('input').forEach(input => {
                    const name = input.name.replace(/\[\d+\]/, `[${index}]`);
                    input.name = name;
                });
            });
            performerCount = performers.length;
        }

        // Form Validation
        document.getElementById('editEventForm').addEventListener('submit', function(e) {
            const eventDate = new Date(document.getElementById('event_date').value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (eventDate < today) {
                e.preventDefault();
                alert('Event date cannot be in the past.');
                return false;
            }

            const maxAttends = parseInt(document.getElementById('max_attends').value);
            const currentRegistrations = {{ $event->eventRegisters->count() }};

            if (maxAttends < currentRegistrations) {
                e.preventDefault();
                alert(`Maximum attendees cannot be less than current registrations (${currentRegistrations}).`);
                return false;
            }
        });
    </script>
@endpush
