@extends('layouts.app')

@section('title', 'My Profile - Festivo')

@push('styles')
    <style>
        .profile-page {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding-top: 100px;
            padding-bottom: 60px;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #360185 0%, #8F0177 50%, #DE1A58 100%);
            padding: 3rem 2rem;
            text-align: center;
            color: white;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 3rem;
            font-weight: 700;
            color: #360185;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #360185;
            margin-bottom: 0.5rem;
        }

        .form-control:focus {
            border-color: #360185;
            box-shadow: 0 0 0 0.2rem rgba(54, 1, 133, 0.25);
        }

        .btn-save {
            background-color: #360185;
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background-color: #8F0177;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(54, 1, 133, 0.3);
        }

        .btn-danger-custom {
            background-color: #dc3545;
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger-custom:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .section-title {
            color: #360185;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #F4B342;
            display: inline-block;
        }

        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .danger-zone {
            background-color: #fff5f5;
            border: 2px solid #fee;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 3rem;
        }

        .danger-zone-title {
            color: #dc3545;
            font-weight: 700;
            margin-bottom: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="profile-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-custom mb-4" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-custom mb-4" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Profile Card -->
                    <div class="profile-card">
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="profile-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <h2 class="fw-bold mb-2">{{ Auth::user()->name }}</h2>
                            <p class="mb-0 opacity-90">
                                <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email }}
                            </p>
                            @if (Auth::user()->is_admin)
                                <span class="badge bg-warning text-dark mt-3 px-3 py-2">
                                    <i class="bi bi-shield-fill me-1"></i>Administrator
                                </span>
                            @else
                                <span class="badge bg-light text-dark mt-3 px-3 py-2">
                                    <i class="bi bi-person-fill me-1"></i>User
                                </span>
                            @endif
                        </div>

                        <!-- Profile Body -->
                        <div class="profile-body">
                            <!-- Update Profile Form -->
                            <h3 class="section-title">
                                <i class="bi bi-person-gear me-2"></i>Update Profile Information
                            </h3>

                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-12 mb-4">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-person me-2"></i>Full Name
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', Auth::user()->name) }}" 
                                               required 
                                               autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-12 mb-4">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope me-2"></i>Email Address
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email', Auth::user()->email) }}" 
                                               required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (Auth::user()->email_verified_at === null)
                                            <div class="form-text text-warning">
                                                <i class="bi bi-exclamation-triangle me-1"></i>
                                                Your email address is unverified.
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-save">
                                        <i class="bi bi-check-circle me-2"></i>Save Changes
                                    </button>
                                </div>
                            </form>

                            <!-- Update Password Section -->
                            <hr class="my-5">

                            <h3 class="section-title">
                                <i class="bi bi-shield-lock me-2"></i>Update Password
                            </h3>

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Current Password -->
                                    <div class="col-md-12 mb-4">
                                        <label for="current_password" class="form-label">
                                            <i class="bi bi-key me-2"></i>Current Password
                                        </label>
                                        <input type="password" 
                                               class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                                               id="current_password" 
                                               name="current_password" 
                                               required>
                                        @error('current_password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- New Password -->
                                    <div class="col-md-12 mb-4">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-lock me-2"></i>New Password
                                        </label>
                                        <input type="password" 
                                               class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               required>
                                        @error('password', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">
                                            Password must be at least 8 characters long
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-12 mb-4">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="bi bi-lock-fill me-2"></i>Confirm New Password
                                        </label>
                                        <input type="password" 
                                               class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required>
                                        @error('password_confirmation', 'updatePassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-save">
                                        <i class="bi bi-shield-check me-2"></i>Update Password
                                    </button>
                                </div>
                            </form>

                            <!-- Apply for Event Manager Section -->
                            @if (Auth::user()->role === 'user')
                                <hr class="my-5">

                                <h3 class="section-title">
                                    <i class="bi bi-briefcase me-2"></i>Become an Event Manager
                                </h3>

                                @if (isset($pendingApplication))
                                    <div class="alert alert-warning alert-custom mb-4" role="alert">
                                        <i class="bi bi-clock-history me-2"></i>
                                        Your application is currently <strong>pending review</strong>. An admin will review it shortly.
                                        <br><small class="text-muted">Submitted: {{ $pendingApplication->created_at->format('M d, Y h:i A') }}</small>
                                    </div>
                                @elseif (isset($applicationHistory) && $applicationHistory->status === 'rejected')
                                    <div class="alert alert-danger alert-custom mb-4" role="alert">
                                        <i class="bi bi-x-circle-fill me-2"></i>
                                        Your previous application was <strong>rejected</strong>.
                                        @if ($applicationHistory->rejection_reason)
                                            <br><small>Reason: {{ $applicationHistory->rejection_reason }}</small>
                                        @endif
                                        <br><small class="text-muted">You can apply again.</small>
                                    </div>
                                @else
                                    <div class="alert alert-info alert-custom mb-4" role="alert">
                                        <i class="bi bi-info-circle-fill me-2"></i>
                                        As an Event Manager, you'll be able to create and manage events on our platform.
                                    </div>
                                @endif

                                @if (!isset($pendingApplication))
                                    <form method="POST" action="{{ route('profile.applyManager') }}">
                                        @csrf
                                        
                                        <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
                                            <div class="card-body p-4">
                                                <h5 class="fw-bold mb-3" style="color: #360185;">
                                                    <i class="bi bi-star-fill me-2"></i>Benefits of Being an Event Manager
                                                </h5>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="mb-2">
                                                        <i class="bi bi-check-circle-fill me-2" style="color: #28a745;"></i>
                                                        Create and manage your own events
                                                    </li>
                                                    <li class="mb-2">
                                                        <i class="bi bi-check-circle-fill me-2" style="color: #28a745;"></i>
                                                        Access to event analytics and insights
                                                    </li>
                                                    <li class="mb-2">
                                                        <i class="bi bi-check-circle-fill me-2" style="color: #28a745;"></i>
                                                        Manage vendors and performers
                                                    </li>
                                                    <li class="mb-2">
                                                        <i class="bi bi-check-circle-fill me-2" style="color: #28a745;"></i>
                                                        Handle event registrations
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-save">
                                                <i class="bi bi-award me-2"></i>Apply for Event Manager Status
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            @endif

                            <!-- Delete Account Section -->
                            <div class="danger-zone">
                                <h4 class="danger-zone-title">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Danger Zone
                                </h4>
                                <p class="text-muted mb-3">
                                    Once you delete your account, there is no going back. Please be certain.
                                </p>

                                <button type="button" 
                                        class="btn btn-danger-custom" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteAccountModal">
                                    <i class="bi bi-trash me-2"></i>Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header" style="background-color: #dc3545; color: white; border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title fw-bold" id="deleteAccountModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Account Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body p-4">
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Warning!</strong> This action cannot be undone.
                        </div>

                        <p class="mb-4">
                            Are you sure you want to delete your account? All of your data will be permanently removed from our servers forever. This action cannot be undone.
                        </p>

                            <label for="password_delete" class="form-label fw-semibold">
                                <i class="bi bi-key me-2"></i>Please enter your password to confirm:
                            </label>
                            <input type="password" 
                                   class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                   id="password_delete" 
                                   name="password" 
                                   required 
                                   placeholder="Enter your password">
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>Yes, Delete My Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script>
        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Show delete modal if there are errors
        @if ($errors->userDeletion->any())
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
            deleteModal.show();
        @endif
    </script>
@endpush