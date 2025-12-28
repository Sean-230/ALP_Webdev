<!-- filepath: resources/views/layouts/footer.blade.php -->
<footer class="py-5 text-white" style="background-color: #360185;">
    <div class="container">
        <div class="row g-4 justify-content-between">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 90px; height: 90px; background-color: transparent; padding: 8px; flex-shrink: 0;">
                        <img src="{{ asset('images/Logo ALP Webdev.png') }}" alt="Festivo"
                            style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <h4 class="fw-bold mb-0" style="font-size: 1.5rem;">Festivo</h4>
                </div>
                <p class="opacity-75 mb-4 lh-lg" style="font-size: 0.95rem;">
                    Professional platform for event management and vendors. Connecting clients with trusted vendors
                    for your dream events.
                </p>

                <!-- Social Media Links -->
                <h6 class="fw-semibold mb-3" style="color: #F4B342;">Follow Us</h6>
                <div class="d-flex gap-2">
                    <a href="#"
                        class="btn btn-sm rounded-circle border d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; color: white; border-color: #8F0177 !important; transition: all 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#8F0177'; this.style.borderColor='#8F0177'; this.style.transform='translateY(-3px)';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#8F0177'; this.style.transform='translateY(0)';">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#"
                        class="btn btn-sm rounded-circle border d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; color: white; border-color: #8F0177 !important; transition: all 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#8F0177'; this.style.borderColor='#8F0177'; this.style.transform='translateY(-3px)';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#8F0177'; this.style.transform='translateY(0)';">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#"
                        class="btn btn-sm rounded-circle border d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; color: white; border-color: #8F0177 !important; transition: all 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#8F0177'; this.style.borderColor='#8F0177'; this.style.transform='translateY(-3px)';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#8F0177'; this.style.transform='translateY(0)';">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="https://wa.me/6285852772500"
                        class="btn btn-sm rounded-circle border d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; color: white; border-color: #8F0177 !important; transition: all 0.3s ease;"
                        target="_blank"
                        onmouseover="this.style.backgroundColor='#8F0177'; this.style.borderColor='#8F0177'; this.style.transform='translateY(-3px)';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#8F0177'; this.style.transform='translateY(0)';">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="fw-bold mb-4" style="color: #F4B342;">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="{{ route('home') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2" style="font-size: 0.8rem;"></i>Home
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('vendors') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2" style="font-size: 0.8rem;"></i>Vendors
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('events') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2" style="font-size: 0.8rem;"></i>Events
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('contact') }}" class="footer-link">
                            <i class="bi bi-chevron-right me-2" style="font-size: 0.8rem;"></i>Contact
                        </a>
                    </li>
                </ul>

                <!-- Additional Info -->
                <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <h6 class="fw-semibold mb-3" style="color: #F4B342; font-size: 0.95rem;">Contact Information</h6>
                    <div class="d-flex align-items-start mb-2">
                        <i class="bi bi-telephone-fill me-2 mt-1" style="color: #F4B342; font-size: 0.9rem;"></i>
                        <div>
                            <a href="https://api.whatsapp.com/send/?phone=%2B6281330330450&text&type=phone_number&app_absent=0" class="footer-contact-link d-block mb-1">
                                +62 813-3033-0450
                            </a>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="bi bi-envelope-fill me-2 mt-1" style="color: #F4B342; font-size: 0.9rem;"></i>
                        <div>
                            <a href="mailto:info@festivo.com" class="footer-contact-link d-block">
                                info@festivo.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Operating Hours -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold mb-4" style="color: #F4B342;">Operating Hours</h5>

                <!-- Operating Hours List -->
                <div class="mb-4">
                    <!-- Every Day -->
                    <div class="p-4 rounded-3 mb-3"
                        style="background: linear-gradient(135deg, rgba(247, 82, 112, 0.15) 0%, rgba(247, 202, 201, 0.15) 100%); border-left: 4px solid #DE1A58;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-grow-1">
                                <i class="bi bi-calendar-check fs-4 me-3" style="color: #F4B342;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1 text-white">Every Day</h6>
                                    <p class="mb-0 opacity-75">09:00 AM - 06:00 PM</p>
                                </div>
                            </div>
                            <span class="badge bg-success fs-6 px-3 py-2 ms-3">Open</span>
                        </div>
                    </div>
                </div>

                <!-- Emergency Service Card -->
                <div class="p-4 rounded"
                    style="background: linear-gradient(135deg, rgba(247, 202, 201, 0.2) 0%, rgba(253, 235, 208, 0.2) 100%); border: 2px solid rgba(247, 202, 201, 0.3);">
                    <div class="d-flex align-items-start mb-3">
                        <i class="bi bi-headset fs-4 me-3" style="color: #F4B342;"></i>
                        <div>
                            <h6 class="fw-semibold mb-2" style="color: white;">Event Consultation</h6>
                            <p class="mb-0 opacity-75 small">
                                Contact us for free consultation and planning your event
                            </p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="tel:+6285852772500" class="btn btn-sm flex-fill fw-semibold"
                            style="background-color: #8F0177; color: white; border-radius: 8px; padding: 8px 16px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#DE1A58';"
                            onmouseout="this.style.backgroundColor='#8F0177';">
                            <i class="bi bi-telephone-fill me-1"></i>Call
                        </a>
                        <a href="https://wa.me/6285852772500" class="btn btn-sm flex-fill fw-semibold"
                            style="background-color: transparent; color: white; border: 2px solid #DE1A58; border-radius: 8px; padding: 8px 16px; transition: all 0.3s ease;"
                            target="_blank"
                            onmouseover="this.style.backgroundColor='#DE1A58'; this.style.borderColor='#DE1A58';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#DE1A58';">
                            <i class="bi bi-whatsapp me-1"></i>Chat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.2); opacity: 0.5;">

        <!-- Copyright - Centered -->
        <div class="text-center">
            <p class="mb-0 opacity-75" style="font-size: 0.95rem;">
                &copy; {{ date('Y') }} Festivo. All rights reserved.
            </p>
        </div>
    </div>

    <style>
        /* Footer Links */
        .footer-link {
            color: white;
            opacity: 0.75;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            font-size: 0.95rem;
        }

        .footer-link:hover {
            opacity: 1;
            color: #F4B342;
            transform: translateX(5px);
        }

        .footer-contact-link {
            color: white;
            opacity: 0.75;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .footer-contact-link:hover {
            opacity: 1;
            color: #F4B342;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {

            footer h5,
            footer h6 {
                font-size: 1.1rem;
            }

            footer .btn-sm {
                padding: 6px 12px;
                font-size: 0.85rem;
            }

            footer .rounded-circle {
                width: 60px !important;
                height: 60px !important;
            }

            footer h4 {
                font-size: 1.25rem !important;
            }
        }
    </style>
</footer>
