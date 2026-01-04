@extends('layouts.app')

@section('title', 'Redirecting to WhatsApp - Festivo')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-sm">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="bi bi-whatsapp" style="font-size: 5rem; color: #25D366;"></i>
                    </div>
                    <h2 class="mb-3" style="color: #360185;">Registration Successful!</h2>
                    <p class="lead mb-4">Opening WhatsApp to contact the event manager...</p>
                    
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        Please complete your payment through WhatsApp to confirm your registration.
                    </div>

                    <div class="mt-4">
                        <p class="text-muted mb-3">If WhatsApp doesn't open automatically, click the button below:</p>
                        <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-lg mb-3" 
                            style="background-color: #25D366; color: white; font-weight: 600; border: none; border-radius: 10px;">
                            <i class="bi bi-whatsapp me-2"></i>Open WhatsApp
                        </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-muted">Redirecting you back to the event page in <span id="countdown">3</span> seconds...</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i>Return to Event Page Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Open WhatsApp in a new tab immediately
    window.open('{{ $whatsappUrl }}', '_blank');

    // Countdown and redirect
    let seconds = 3;
    const countdownElement = document.getElementById('countdown');
    
    const interval = setInterval(() => {
        seconds--;
        countdownElement.textContent = seconds;
        
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = '{{ route('events.show', $event->id) }}';
        }
    }, 1000);
</script>
@endpush
