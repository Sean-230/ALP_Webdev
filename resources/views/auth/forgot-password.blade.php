<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <img src="{{ asset('images/logo.png') }}" alt="Depo Es Krim">
            <h3 class="mb-1">Lupa Kata Sandi?</h3>
            <p class="mb-0 opacity-75">Reset kata sandi Anda</p>
        </div>

        <div class="auth-body">
            <p class="text-muted mb-4">
                Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk mereset kata sandi.
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
                           placeholder="nama@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-envelope me-2"></i>Kirim Link Reset
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="auth-link">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
