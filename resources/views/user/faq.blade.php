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

    <!-- General Questions -->
    <section id="general" class="py-5" style="background-color: #ffffff;">
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
                                    verified vendors. We help you plan, manage, and execute successful events by providing
                                    access to hundreds
                                    of trusted vendors across multiple categories including catering, photography, venues,
                                    and more.
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
                                    through our platform. You can compare vendors, read reviews, check availability, and
                                    manage all your bookings
                                    in one place. Our team ensures all vendors are verified and professional.
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
                                    services you book. There are no hidden fees or subscription charges for using Festivo.
                                </div>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#general4">
                                    What types of events can I plan on Festivo?
                                </button>
                            </h3>
                            <div id="general4" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                <div class="accordion-body">
                                    You can plan any type of event on Festivo including weddings, birthday parties,
                                    corporate events,
                                    conferences, music concerts, festivals, and more. Our platform supports events of all
                                    sizes and types.
                                </div>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#general5">
                                    How do I get started with Festivo?
                                </button>
                            </h3>
                            <div id="general5" class="accordion-collapse collapse" data-bs-parent="#generalAccordion">
                                <div class="accordion-body">
                                    Simply create a free account by clicking the "Register" button. Once logged in, you can
                                    browse
                                    events, explore vendors, and start planning your event. You can also register as an
                                    event manager
                                    to create and manage your own events.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking & Payment -->
    <section id="booking" class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-section-header mb-5">
                        <div class="faq-section-icon">
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
                                    How do I register for an event?
                                </button>
                            </h3>
                            <div id="booking1" class="accordion-collapse collapse show" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    Browse available events, select the one you want to attend, check the details and
                                    available slots,
                                    then click the "Register" button. Fill in your information and the number of tickets you
                                    need.
                                    You'll receive instant confirmation via email once your registration is complete.
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
                                    bank transfers. All payments are processed securely through our encrypted payment
                                    gateway.
                                </div>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#booking3">
                                    Can I cancel or modify my registration?
                                </button>
                            </h3>
                            <div id="booking3" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    Yes, you can cancel or modify your event registration according to the event organizer's
                                    policy.
                                    Most events offer free cancellation up to 7 days before the event date. Please check the
                                    specific
                                    event's cancellation policy before registering.
                                </div>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#booking4">
                                    How do I receive my event tickets?
                                </button>
                            </h3>
                            <div id="booking4" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    After successful registration, you'll receive your tickets via email. You can also
                                    access and
                                    download your tickets from your account dashboard. Simply show the ticket (digital or
                                    printed)
                                    at the event entrance.
                                </div>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#booking5">
                                    What if an event is sold out?
                                </button>
                            </h3>
                            <div id="booking5" class="accordion-collapse collapse" data-bs-parent="#bookingAccordion">
                                <div class="accordion-body">
                                    If an event shows "Sold out", all available slots are currently filled. You can add
                                    yourself
                                    to the waitlist to be notified if spots become available due to cancellations. We'll
                                    email you
                                    immediately if a slot opens up.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vendor Information -->
    <section id="vendors" class="py-5" style="background-color: #ffffff;">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-section-header mb-5">
                        <div class="faq-section-icon">
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
                                    What are F&B vendor stands?
                                </button>
                            </h3>
                            <div id="vendors1" class="accordion-collapse collapse show"
                                data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    F&B (Food & Beverage) vendor stands are food and drink stalls that can be booked for
                                    your event.
                                    Event managers can select and book multiple vendors to provide diverse food options for
                                    their attendees.
                                    Each vendor brings their unique menu and culinary expertise to your event.
                                </div>
                            </div>
                        </div>

                        <!-- Question 2 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors2">
                                    How can event managers book vendors?
                                </button>
                            </h3>
                            <div id="vendors2" class="accordion-collapse collapse" data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    Event managers can browse available vendors on the platform, view their menus and
                                    pricing,
                                    and send booking requests directly. Vendors will confirm availability and finalize
                                    details
                                    with you for your specific event date and requirements.
                                </div>
                            </div>
                        </div>

                        <!-- Question 3 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors3">
                                    Are all vendors verified?
                                </button>
                            </h3>
                            <div id="vendors3" class="accordion-collapse collapse" data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    Yes! All vendors on Festivo undergo a thorough verification process. We check their
                                    credentials, business licenses, food safety certifications, and review their portfolio.
                                    Only professional
                                    and reliable vendors are approved to offer their services on our platform.
                                </div>
                            </div>
                        </div>

                        <!-- Question 4 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors4">
                                    How do I become a vendor on Festivo?
                                </button>
                            </h3>
                            <div id="vendors4" class="accordion-collapse collapse" data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    Register as a vendor manager on our platform, submit your business information and
                                    required documents,
                                    and wait for our team to review your application. Once approved, you can create your
                                    vendor profile,
                                    upload menu items, set pricing, and start receiving booking requests from event
                                    organizers.
                                </div>
                            </div>
                        </div>

                        <!-- Question 5 -->
                        <div class="faq-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#vendors5">
                                    Can I customize vendor services for my event?
                                </button>
                            </h3>
                            <div id="vendors5" class="accordion-collapse collapse" data-bs-parent="#vendorsAccordion">
                                <div class="accordion-body">
                                    Absolutely! After booking a vendor, you can communicate directly with them to discuss
                                    custom
                                    menu options, special dietary requirements, portion sizes, and any other specific needs
                                    for your event.
                                    Most vendors are happy to accommodate reasonable customization requests.
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
