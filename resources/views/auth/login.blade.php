<x-guest-layout>
    @section('body-class', 'login-page')
    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-link text-decoration-none p-0">
            <i class="bi bi-arrow-left me-2"></i>Back to Home
        </a>
    </div>
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo-circle">
                <img src="{{ asset('images/Logo ALP Webdev.png') }}" alt="Depo Es Krim">
            </div>
            <h3 class="mb-1">Welcome Back</h3>
            <p class="mb-0 opacity-75">Sign in to your account</p>
        </div>

        <div class="auth-body">
            @if (session('status'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" 
                           required autofocus autocomplete="username"
                           placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" 
                           required autocomplete="current-password"
                           placeholder="Enter your password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>
                </div>

                <div class="text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-link d-block mb-3">
                            Forgot your password?
                        </a>
                    @endif

                    <p class="mb-0">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="auth-link">Register now</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
