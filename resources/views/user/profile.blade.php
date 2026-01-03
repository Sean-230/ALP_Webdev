@extends('layouts.app')

@section('title', 'My Profile - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user-profile.css') }}">
@endpush

@section('content')
    <div class="profile-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible alert-custom" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible alert-custom" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Profile Card -->
                    <div class="profile-card mb-3">
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="profile-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                            <p class="mb-0 opacity-90 small">
                                <i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}
                            </p>
                            <div class="mt-2">
                                @if (Auth::user()->role === 'admin')
                                    <span class="badge bg-warning text-dark px-3 py-1">
                                        <i class="bi bi-shield-fill me-1"></i>Administrator
                                    </span>
                                @elseif (Auth::user()->role === 'eventManager')
                                    <span class="badge bg-success px-3 py-1">
                                        <i class="bi bi-briefcase-fill me-1"></i>Event Manager
                                    </span>
                                @elseif (Auth::user()->role === 'vendorManager')
                                    <span class="badge bg-primary px-3 py-1">
                                        <i class="bi bi-shop me-1"></i>Vendor Manager
                                    </span>
                                @else
                                    <span class="badge bg-light text-dark px-3 py-1">
                                        <i class="bi bi-person-fill me-1"></i>User
                                    </span>
                                    @if (isset($pendingApplication))
                                        <span class="badge bg-info text-dark px-3 py-1 ms-1">
                                            <i class="bi bi-clock-history me-1"></i>Applied for
                                            @if ($pendingApplication->role_type === 'eventManager')
                                                Event Manager
                                            @else
                                                Vendor Manager
                                            @endif
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </div>

                        <!-- Profile Body -->
                        <div class="profile-body">
                            <!-- Update Profile -->
                            <h5 class="section-title">
                                <i class="bi bi-person-gear me-2"></i>Update Profile
                            </h5>

                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="name" class="form-label small fw-semibold">
                                        <i class="bi bi-person me-1"></i>Full Name
                                    </label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label small fw-semibold">
                                        <i class="bi bi-envelope me-1"></i>Email Address
                                    </label>
                                    <input type="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if (!Auth::user()->hasVerifiedEmail())
                                        <div class="alert alert-warning mt-2 p-2 d-flex align-items-center justify-content-between"
                                            style="border-radius: 8px;">
                                            <div class="small">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                                <strong>Not Verified</strong>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-warning"
                                                onclick="document.getElementById('verifyEmailForm').submit()">
                                                Verify
                                            </button>
                                        </div>
                                    @else
                                        <div class="form-text text-success small">
                                            <i class="bi bi-check-circle-fill me-1"></i>Verified
                                        </div>
                                    @endif
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-save">
                                        <i class="bi bi-check-circle me-1"></i>Save Changes
                                    </button>
                                </div>
                            </form>

                            <form id="verifyEmailForm" method="POST" action="{{ route('profile.verifyEmail') }}"
                                style="display: none;">
                                @csrf
                            </form>

                            <!-- Update Password -->
                            <hr>

                            <h5 class="section-title">
                                <i class="bi bi-shield-lock me-2"></i>Update Password
                            </h5>

                            <form method="POST" action="{{ route('profile.password.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="current_password" class="form-label small fw-semibold">
                                        <i class="bi bi-key me-1"></i>Current Password
                                    </label>
                                    <input type="password"
                                        class="form-control form-control-sm @error('current_password', 'updatePassword') is-invalid @enderror"
                                        id="current_password" name="current_password" required>
                                    @error('current_password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label small fw-semibold">
                                        <i class="bi bi-lock me-1"></i>New Password
                                    </label>
                                    <input type="password"
                                        class="form-control form-control-sm @error('password', 'updatePassword') is-invalid @enderror"
                                        id="password" name="password" required>
                                    @error('password', 'updatePassword')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text small">Min 8 characters</div>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label small fw-semibold">
                                        <i class="bi bi-lock-fill me-1"></i>Confirm Password
                                    </label>
                                    <input type="password" class="form-control form-control-sm"
                                        id="password_confirmation" name="password_confirmation" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-save">
                                        <i class="bi bi-shield-check me-1"></i>Update Password
                                    </button>
                                </div>
                            </form>

                            <!-- Become a Manager / Danger Zone Section -->
                            @if (Auth::user()->role === 'user')
                                <hr>

                                <!-- Become a Manager -->
                                <h5 class="section-title">
                                    <i class="bi bi-briefcase me-2"></i>Become a Manager
                                </h5>

                                @if (isset($pendingApplication))
                                    <div class="alert alert-warning alert-custom p-2" role="alert">
                                        <i class="bi bi-clock-history me-2"></i>
                                        Your application is <strong>pending review</strong>.
                                        <br><small
                                            class="text-muted">{{ $pendingApplication->created_at->format('M d, Y') }}</small>
                                    </div>
                                @elseif (isset($applicationHistory) && $applicationHistory->status === 'rejected')
                                    <div class="alert alert-danger alert-custom p-2" role="alert">
                                        <i class="bi bi-x-circle-fill me-2"></i>
                                        Application <strong>rejected</strong>.
                                        @if ($applicationHistory->rejection_reason)
                                            <br><small>{{ $applicationHistory->rejection_reason }}</small>
                                        @endif
                                    </div>
                                @endif

                                @if (!isset($pendingApplication))
                                    <form method="POST" action="{{ route('profile.applyManager') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label small fw-semibold"><i
                                                    class="bi bi-person-badge me-1"></i>Select Role</label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="radio" class="btn-check" name="role_type"
                                                        id="event_manager" value="event_manager" checked required>
                                                    <label class="btn btn-outline-primary w-100 p-3" for="event_manager"
                                                        style="border-radius: 10px;">
                                                        <i class="bi bi-calendar-event d-block mb-1"
                                                            style="font-size: 1.5rem;"></i>
                                                        <div class="fw-semibold small">Event Manager</div>
                                                        <small class="text-muted" style="font-size: 0.75rem;">Create
                                                            events</small>
                                                    </label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" class="btn-check" name="role_type"
                                                        id="vendor_manager" value="vendor_manager" required>
                                                    <label class="btn btn-outline-primary w-100 p-3" for="vendor_manager"
                                                        style="border-radius: 10px;">
                                                        <i class="bi bi-shop d-block mb-1" style="font-size: 1.5rem;"></i>
                                                        <div class="fw-semibold small">Vendor Manager</div>
                                                        <small class="text-muted" style="font-size: 0.75rem;">Manage
                                                            vendors</small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card border-0 shadow-sm mb-3" style="border-radius: 10px;">
                                            <div class="card-body p-3">
                                                <h6 class="fw-bold mb-2" style="color: #360185; font-size: 0.9rem;">
                                                    <i class="bi bi-star-fill me-1"></i>Benefits
                                                </h6>
                                                <div class="row small">
                                                    <div class="col-6">
                                                        <p class="fw-semibold mb-1"
                                                            style="color: #360185; font-size: 0.85rem;">Event:</p>
                                                        <ul class="list-unstyled mb-0" style="font-size: 0.8rem;">
                                                            <li class="mb-1"><i
                                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Create
                                                                events</li>
                                                            <li class="mb-1"><i
                                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Analytics
                                                            </li>
                                                            <li><i
                                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Registrations
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="fw-semibold mb-1"
                                                            style="color: #360185; font-size: 0.85rem;">Vendor:</p>
                                                        <ul class="list-unstyled mb-0" style="font-size: 0.8rem;">
                                                            <li class="mb-1"><i
                                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Manage
                                                                services</li>
                                                            <li class="mb-1"><i
                                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Bookings
                                                            </li>
                                                            <li><i
                                                                    class="bi bi-check-circle-fill me-1 text-success"></i>Dashboard
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-save">
                                                <i class="bi bi-award me-1"></i>Submit Application
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @endif

                            <hr>

                            <!-- Danger Zone -->
                            <div class="danger-zone">
                                <h6 class="danger-zone-title">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Danger Zone
                                </h6>
                                <p class="text-muted mb-2 small">
                                    Once deleted, there's no going back.
                                </p>
                                <button type="button" class="btn btn-danger-custom btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteAccountModal">
                                    <i class="bi bi-trash me-1"></i>Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header" style="background-color: #dc3545; color: white; border-radius: 15px 15px 0 0;">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body p-4">
                        <div class="alert alert-danger p-2" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Warning!</strong> This cannot be undone.
                        </div>

                        <p class="mb-3">
                            All your data will be permanently removed. This action cannot be undone.
                        </p>

                        <label for="password_delete" class="form-label fw-semibold small">
                            <i class="bi bi-key me-1"></i>Enter password to confirm:
                        </label>
                        <input type="password"
                            class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                            id="password_delete" name="password" required placeholder="Your password">
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash me-1"></i>Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @if ($errors->userDeletion->any())
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            deleteModal.show();
        @endif
    </script>
@endpush
