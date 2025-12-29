<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Ticket - {{ $booking->event->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #360185 0%, #8F0177 50%, #DE1A58 100%);
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ticket-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .ticket {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            position: relative;
        }

        .ticket-header {
            background: linear-gradient(135deg, #360185 0%, #8F0177 100%);
            color: white;
            padding: 2rem;
            position: relative;
        }

        .ticket-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 20px;
            background: white;
            border-radius: 50% 50% 0 0 / 100% 100% 0 0;
        }

        .ticket-body {
            padding: 2.5rem;
        }

        .ticket-divider {
            border-top: 2px dashed #dee2e6;
            margin: 2rem 0;
            position: relative;
        }

        .ticket-divider::before,
        .ticket-divider::after {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #360185 0%, #8F0177 100%);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .ticket-divider::before {
            left: -45px;
        }

        .ticket-divider::after {
            right: -45px;
        }

        .qr-code {
            width: 150px;
            height: 150px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #360185;
        }

        .info-row {
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: #212529;
            font-weight: 500;
        }

        .ticket-id {
            background: linear-gradient(135deg, rgba(54, 1, 133, 0.1) 0%, rgba(143, 1, 119, 0.1) 100%);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            display: inline-block;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #360185;
            font-size: 1.2rem;
        }

        .valid-badge {
            background: #d4edda;
            color: #155724;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
        }

        .btn-download {
            background: linear-gradient(135deg, #360185 0%, #8F0177 100%);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-download:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(54, 1, 133, 0.3);
            color: white;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="ticket">
            <div class="ticket-header">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h1 class="mb-2">{{ $booking->event->name }}</h1>
                        <p class="mb-0 opacity-75">
                            <i class="bi bi-calendar-event me-2"></i>
                            {{ \Carbon\Carbon::parse($booking->event->event_date)->format('l, F d, Y') }}
                        </p>
                        <p class="mb-0 opacity-75">
                            <i class="bi bi-clock me-2"></i>
                            {{ \Carbon\Carbon::parse($booking->event->start_time)->format('g:i A') }}
                            - {{ \Carbon\Carbon::parse($booking->event->end_time)->format('g:i A') }}
                        </p>
                    </div>
                    <div class="text-end">
                        <div class="valid-badge">
                            <i class="bi bi-check-circle me-1"></i>VALID
                        </div>
                    </div>
                </div>
            </div>

            <div class="ticket-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <span class="info-label d-block">TICKET ID</span>
                            <span class="ticket-id">#{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div class="info-row">
                            <div class="info-label">ATTENDEE NAME</div>
                            <div class="info-value">{{ $booking->user->name }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">EMAIL</div>
                            <div class="info-value">{{ $booking->user->email }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">NUMBER OF TICKETS</div>
                            <div class="info-value">
                                <i class="bi bi-ticket-perforated me-2" style="color: #360185;"></i>
                                {{ $booking->ticket_qty }} Ticket(s)
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">VENUE</div>
                            <div class="info-value">
                                <i class="bi bi-geo-alt me-2" style="color: #360185;"></i>
                                {{ $booking->event->location }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">CATEGORY</div>
                            <div class="info-value">
                                <i class="bi bi-bookmark me-2" style="color: #360185;"></i>
                                {{ $booking->event->category->name ?? 'General' }}
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">TOTAL PAID</div>
                            <div class="info-value" style="color: #360185; font-size: 1.3rem;">
                                Rp {{ number_format($booking->ticket_qty * 150000, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <div class="qr-code mx-auto">
                            <div>
                                <i class="bi bi-qr-code" style="font-size: 5rem; color: #360185;"></i>
                                <div class="mt-2 small text-muted">Scan at Entry</div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted d-block">Booking Date</small>
                            <strong>{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="ticket-divider"></div>

                <div class="text-center mt-4">
                    <p class="text-muted mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        Please present this ticket at the event entrance. 
                        Keep this ticket safe and do not share with others.
                    </p>
                    <div class="no-print">
                        <button onclick="window.print()" class="btn-download me-2">
                            <i class="bi bi-printer me-2"></i>Print Ticket
                        </button>
                        <a href="{{ route('bookings.index') }}" class="btn-download">
                            <i class="bi bi-arrow-left me-2"></i>Back to Bookings
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4 no-print">
            <p class="text-white">
                <i class="bi bi-shield-check me-2"></i>
                This is an official ticket issued by Festivo Event Management
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
