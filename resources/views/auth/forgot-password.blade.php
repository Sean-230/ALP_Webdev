<x-guest-layout>
    @section('body-class', 'forgot-password-page')
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo-circle" style="width: 70px; height: 70px;">
                <img src="{{ asset('images/Logo ALP Webdev.png') }}" alt="Festivo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <h3 class="mb-1">Forgot Password?</h3>
            <p class="mb-0 opacity-75">Reset your password</p>
        </div>

        <div class="auth-body">
            <p class="text-muted mb-4">
                No problem! Enter your email and we will send you a link to reset your password.
            </p>

            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           required autofocus
                           placeholder="name@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-envelope me-2"></i>Send Reset Link
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="bi bi-arrow-left me-1"></i>Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
