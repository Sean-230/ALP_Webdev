@extends('layouts.app')

@section('title', 'FAQ - Festivo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="faq-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4">Frequently Asked Questions</h1>
                    <p class="fs-5 mb-4 opacity-90">
                        Find answers to common questions about Festivo. Can't find what you're looking for?
                        Contact our support team.
                    </p>
                    <a href="/contact" class="btn btn-light btn-lg px-4 py-3">
                        <i class="bi bi-headset me-2"></i>Contact Support
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="faq-hero-illustration">
                        <i class="bi bi-question-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Categories -->
    <section class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3" style="color: #360185;">Browse by Category</h2>
                <p class="text-muted fs-5">Select a category to find answers</p>
            </div>

            <div class="row g-4 mb-5">
                <!-- Category 1 -->
                <div class="col-md-4">
                    <a href="#general" class="faq-category-card">
                        <div class="faq-category-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h5 class="fw-bold mb-2">General Questions</h5>
                        <p class="text-muted mb-0 small">Basic information about Festivo</p>
                    </a>
                </div>

                <!-- Category 2 -->
                <div class="col-md-4">
                    <a href="#booking" class="faq-category-card">
                        <div class="faq-category-icon"
                            style="background: linear-gradient(135deg, #8F0177 0%, #DE1A58 100%);">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Booking & Payment</h5>
                        <p class="text-muted mb-0 small">How to book and pay for services</p>
                    </a>
                </div>

                <!-- Category 3 -->
                <div class="col-md-4">
                    <a href="#vendors" class="faq-category-card">
                        <div class="faq-category-icon"
                            style="background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Vendor Information</h5>
                        <p class="text-muted mb-0 small">About our vendors and services</p>
                    </a>
                </div>

                <!-- Category 4 -->
                <div class="col-md-4">
                    <a href="#account" class="faq-category-card">
                        <div class="faq-category-icon"
                            style="background: linear-gradient(135deg, #F4B342 0%, #360185 100%);">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Account & Profile</h5>
                        <p class="text-muted mb-0 small">Managing your account settings</p>
                    </a>
                </div>

                <!-- Category 5 -->
                <div class="col-md-4">
                    <a href="#events" class="faq-category-card">
                        <div class="faq-category-icon"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Event Planning</h5>
                        <p class="text-muted mb-0 small">Tips for planning your event</p>
                    </a>
                </div>

                <!-- Category 6 -->
                <div class="col-md-4">
                    <a href="#support" class="faq-category-card">
                        <div class="faq-category-icon"
                            style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Support & Help</h5>
                        <p class="text-muted mb-0 small">Getting help when you need it</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- General Questions -->
    <section id="general" class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-section-header mb-5">
                        <div class="faq-section-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h2 class="display-6 fw-bold">General Questions</h2>
                    </div>

                    <div class="accordion" id="generalAccordion">
                        <!-- Question 1 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#general1">
                                    What is Festivo?
                                </button>
                            </h3>
                            <div id="general1" class="accordion-collapse collapse show" data-bs-parent="#generalAccordion">
                                <div class="accordion-body">
                                    Festivo is a comprehensive event planning platform that connects event organizers with
                                    verified vendors.
                                    We help you plan, manage, and execute successful events by providing access to hundreds
                                    of trusted vendors
                                    across multiple categories including catering, photography, venues, and more.
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#general2">
                                    How does Festivo work?
                                </button>
                            </h3>
                            <div id="general2" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                <div class="accordion-body">
                                    Simply browse our vendor categories, select the services you need, and book directly
                                    through our platform.
                                    You can compare vendors, read reviews, check availability, and manage all your bookings
                                    in one place.
                                    Our team ensures all vendors are verified and professional.
                                </div>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#general3">
                                    Is Festivo free to use?
                                </button>
                            </h3>
                            <div id="general3" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                <div class="accordion-body">
                                    Yes! Creating an account and browsing vendors is completely free. You only pay for the
                                    services you book.
                                    There are no hidden fees or subscription charges for using Festivo.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking & Payment -->
    <section id="booking" class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-section-header mb-5">
                        <div class="faq-section-icon"
                            style="background: linear-gradient(135deg, #8F0177 0%, #DE1A58 100%);">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h2 class="display-6 fw-bold">Booking & Payment</h2>
                    </div>

                    <div class="accordion" id="bookingAccordion">
                        <!-- Question 1 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#booking1">
                                    How do I book a vendor?
                                </button>
                            </h3>
                            <div id="booking1" class="accordion-collapse collapse show"
                                data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    Browse vendors, select the one you want, check their availability, and click the "Book
                                    Now" button.
                                    Fill in your event details, choose your package, and proceed to payment. You'll receive
                                    instant confirmation
                                    via email once your booking is confirmed.
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#booking2">
                                    What payment methods are accepted?
                                </button>
                            </h3>
                            <div id="booking2" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    We accept all major credit cards (Visa, Mastercard, American Express), debit cards, and
                                    bank transfers.
                                    All payments are processed securely through our encrypted payment gateway.
                                </div>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#booking3">
                                    Can I cancel or modify my booking?
                                </button>
                            </h3>
                            <div id="booking3" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    Yes, you can cancel or modify bookings according to the vendor's cancellation policy.
                                    Most vendors offer free cancellation up to 7 days before the event. Please check the
                                    specific
                                    vendor's policy before booking.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vendor Information -->
    <section id="vendors" class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-section-header mb-5">
                        <div class="faq-section-icon"
                            style="background: linear-gradient(135deg, #DE1A58 0%, #F4B342 100%);">
                            <i class="bi bi-shop"></i>
                        </div>
                        <h2 class="display-6 fw-bold">Vendor Information</h2>
                    </div>

                    <div class="accordion" id="vendorsAccordion">
                        <!-- Question 1 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors1">
                                    Are all vendors verified?
                                </button>
                            </h3>
                            <div id="vendors1" class="accordion-collapse collapse show"
                                data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    Yes! All vendors on Festivo undergo a thorough verification process. We check their
                                    credentials,
                                    business licenses, and review their portfolio. Only professional and reliable vendors
                                    are approved
                                    to list their services on our platform.
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors2">
                                    How can I contact a vendor?
                                </button>
                            </h3>
                            <div id="vendors2" class="accordion-collapse collapse" data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    You can message vendors directly through our platform's messaging system. Once you're
                                    logged in,
                                    visit the vendor's profile and click "Contact Vendor" to send them a message about your
                                    requirements.
                                </div>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors3">
                                    Can I leave a review for a vendor?
                                </button>
                            </h3>
                            <div id="vendors3" class="accordion-collapse collapse" data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    Absolutely! We encourage all clients to leave honest reviews after their event. Your
                                    feedback helps
                                    other users make informed decisions and helps vendors improve their services. You can
                                    leave a review
                                    from your bookings page after the event date.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Smooth scroll for category links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush
