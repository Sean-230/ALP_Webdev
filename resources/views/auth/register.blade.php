<x-guest-layout>
    @section('body-class', 'register-page')
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo-circle">
                <img src="{{ asset('images/logo_transparan.png') }}" alt="Depo Es Krim">
            </div>
            <h3 class="mb-0">Create New Account</h3>
            <p class="mb-0 opacity-75">Join us today</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-2">
                    <label for="name" class="form-label fw-semibold">Username</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" 
                           required autofocus autocomplete="name"
                           placeholder="Enter your username">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-2">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           required autocomplete="username"
                           placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" 
                           required autocomplete="new-password"
                           placeholder="Minimum 8 characters">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-2">
                    <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" 
                           required autocomplete="new-password"
                           placeholder="Re-enter your password">
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Register
                    </button>
                </div>

                <div class="text-center">
                    <p class="mb-0">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="auth-link">Sign in now</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
