<x-guest-layout>
    <div class="auth-card">
        <div class="auth-header">
            <img src="{{ asset('images/logo.png') }}" alt="Depo Es Krim">
            <h3 class="mb-1">Reset Kata Sandi</h3>
            <p class="mb-0 opacity-75">Buat kata sandi baru Anda</p>
        </div>

        <div class="auth-body">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $request->email) }}" 
                           required autofocus autocomplete="username"
                           placeholder="nama@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" 
                           required autocomplete="new-password"
                           placeholder="Minimal 8 karakter">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" 
                           required autocomplete="new-password"
                           placeholder="Ulangi kata sandi baru">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-shield-check me-2"></i>Reset Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
