@extends('layouts.app')

@section('title', 'Festivo - Platform Manajemen Event & Vendor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(135deg, #4E61D3 0%, #CFADC1 100%); padding: 140px 0 100px; margin-top: 76px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 text-white lh-sm">Wujudkan Event <br> Impian Anda </h1>
                    <p class="fs-5 mb-5 text-white opacity-90 lh-lg">
                        Platform terpercaya untuk menemukan vendor profesional dan mengelola event Anda. Dari konser, seminar, hingga festival - semua dalam satu tempat.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="/vendors" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: #F4F754; color: #4E61D3; border-radius: 10px; transition: all 0.3s ease; font-weight: 600;"
                            onmouseover="this.style.backgroundColor='#E9D484'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 5px 20px rgba(244, 247, 84, 0.4)';"
                            onmouseout="this.style.backgroundColor='#F4F754'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            <i class="bi bi-briefcase me-2"></i>Cari Vendor
                        </a>
                        <a href="/events" class="btn btn-lg px-5 py-3 fw-semibold"
                            style="background-color: transparent; color: white; border: 2px solid white; border-radius: 10px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='white'; this.style.color='#4E61D3';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='white';">
                            <i class="bi bi-calendar-event me-2"></i>Lihat Event
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Stats Grid -->
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="p-4 rounded-3 text-center" style="background-color: rgba(244, 247, 84, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                <h2 class="display-4 fw-bold text-white mb-2" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);">250+</h2>
                                <p class="text-white mb-0" style="font-weight: 600; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Vendor Terdaftar</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 rounded-3 text-center" style="background-color: rgba(233, 212, 132, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                <h2 class="display-4 fw-bold text-white mb-2" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);">1000+</h2>
                                <p class="text-white mb-0" style="font-weight: 600; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Event Sukses</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 rounded-3 text-center" style="background-color: rgba(233, 212, 132, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                <h2 class="display-4 fw-bold text-white mb-2" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);">50K+</h2>
                                <p class="text-white mb-0" style="font-weight: 600; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Peserta Event</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-4 rounded-3 text-center" style="background-color: rgba(244, 247, 84, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                <h2 class="display-4 fw-bold text-white mb-2" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.5);">25+</h2>
                                <p class="text-white mb-0" style="font-weight: 600; text-shadow: 1px 1px 4px rgba(0,0,0,0.5);">Kota</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Categories Section -->
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" style="color: #173648;">Kategori Event</h2>
                    <p class="text-muted fs-5">Berbagai jenis event yang dapat kami bantu wujudkan</p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <!-- Conference -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)';">
                        <div class="position-relative overflow-hidden"
                            style="height: 200px; border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #173648 0%, #0A5A99 100%);">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-people" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #173648;">Konferensi</h5>
                            <p class="text-muted mb-3">
                                Event profesional untuk seminar, workshop, dan pertemuan bisnis skala besar
                            </p>
                            <a href="/vendors?category=conference" class="text-decoration-none fw-semibold" style="color: #1C7FDD;">
                                Lihat Vendor <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Concert -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)';">
                        <div class="position-relative overflow-hidden"
                            style="height: 200px; border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #1C7FDD 0%, #0FB7D4 100%);">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-music-note-beamed" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #173648;">Konser & Musik</h5>
                            <p class="text-muted mb-3">
                                Pertunjukan musik live, festival musik, dan acara entertainment
                            </p>
                            <a href="/vendors?category=concert" class="text-decoration-none fw-semibold" style="color: #1C7FDD;">
                                Lihat Vendor <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Wedding -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)';">
                        <div class="position-relative overflow-hidden"
                            style="height: 200px; border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #0A5A99 0%, #0FB7D4 100%);">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-suit-heart" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #173648;">Pernikahan</h5>
                            <p class="text-muted mb-3">
                                Wujudkan pernikahan impian dengan vendor terpercaya dan profesional
                            </p>
                            <a href="/vendors?category=wedding" class="text-decoration-none fw-semibold" style="color: #1C7FDD;">
                                Lihat Vendor <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Festival -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)';">
                        <div class="position-relative overflow-hidden"
                            style="height: 200px; border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #0FB7D4 0%, #1C7FDD 100%);">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-balloon" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #173648;">Festival</h5>
                            <p class="text-muted mb-3">
                                Festival budaya, kuliner, dan acara outdoor berskala besar
                            </p>
                            <a href="/vendors?category=festival" class="text-decoration-none fw-semibold" style="color: #1C7FDD;">
                                Lihat Vendor <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Corporate -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)';">
                        <div class="position-relative overflow-hidden"
                            style="height: 200px; border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #173648 0%, #1C7FDD 100%);">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-building" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #173648;">Corporate Event</h5>
                            <p class="text-muted mb-3">
                                Acara perusahaan, team building, dan gathering karyawan
                            </p>
                            <a href="/vendors?category=corporate" class="text-decoration-none fw-semibold" style="color: #1C7FDD;">
                                Lihat Vendor <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Exhibition -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; transition: all 0.3s ease; cursor: pointer;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 10px rgba(0,0,0,0.1)';">
                        <div class="position-relative overflow-hidden"
                            style="height: 200px; border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #0A5A99 0%, #0FB7D4 100%);">
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-shop" style="font-size: 5rem; color: white; opacity: 0.9;"></i>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: #173648;">Pameran</h5>
                            <p class="text-muted mb-3">
                                Pameran produk, expo, dan acara showcase untuk bisnis Anda
                            </p>
                            <a href="/vendors?category=exhibition" class="text-decoration-none fw-semibold" style="color: #1C7FDD;">
                                Lihat Vendor <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="/vendors" class="btn btn-lg px-5 py-3 fw-semibold"
                    style="background-color: #173648; color: white; border-radius: 10px; transition: all 0.3s ease;"
                    onmouseover="this.style.backgroundColor='#1C7FDD'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.backgroundColor='#173648'; this.style.transform='translateY(0)';">
                    Lihat Semua Vendor <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="display-5 fw-bold mb-3" style="color: #4E61D3;">Mengapa Memilih Festivo?</h2>
                    <p class="text-muted fs-5">Kami menyediakan solusi terbaik untuk kebutuhan event Anda</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #173648 0%, #0A5A99 100%);">
                                <i class="bi bi-shield-check fs-2 text-white"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3" style="color: #173648;">Vendor Terverifikasi</h5>
                        <p class="text-muted">
                            Semua vendor telah melalui proses verifikasi ketat untuk memastikan kualitas layanan terbaik
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #1C7FDD 0%, #0FB7D4 100%);">
                                <i class="bi bi-wallet2 fs-2 text-white"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3" style="color: #173648;">Harga Transparan</h5>
                        <p class="text-muted">
                            Tidak ada biaya tersembunyi, semua harga jelas dan dapat dibandingkan dengan mudah
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #0A5A99 0%, #0FB7D4 100%);">
                                <i class="bi bi-headset fs-2 text-white"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3" style="color: #173648;">Dukungan 24/7</h5>
                        <p class="text-muted">
                            Tim customer service kami siap membantu Anda kapan saja untuk kesuksesan event Anda
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="text-center p-4">
                        <div class="mb-4">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #0FB7D4 0%, #1C7FDD 100%);">
                                <i class="bi bi-star-fill fs-2 text-white"></i>
                            </div>
                        </div>
                        <h5 class="fw-bold mb-3" style="color: #173648;">Terpercaya</h5>
                        <p class="text-muted">
                            Dipercaya oleh ribuan klien dengan rating tinggi dan review positif dari pengguna
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #173648 0%, #1C7FDD 100%);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
                    <h2 class="display-6 fw-bold text-white mb-3">Siap Membuat Event Anda?</h2>
                    <p class="text-white opacity-90 fs-5 mb-0">
                        Bergabunglah dengan ribuan penyelenggara event yang telah mempercayai kami
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <a href="/contact" class="btn btn-lg px-5 py-3 fw-semibold"
                        style="background-color: #0FB7D4; color: white; border-radius: 10px; transition: all 0.3s ease; font-weight: 600;"
                        onmouseover="this.style.backgroundColor='#0A5A99'; this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.backgroundColor='#0FB7D4'; this.style.transform='translateY(0)';">
                        <i class="bi bi-envelope me-2"></i>Hubungi Kami
                    </a>
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
                navbar.style.padding = '0.5rem 0';
                navbar.style.boxShadow = '0 4px 15px rgba(0,0,0,0.15)';
            } else {
                navbar.style.padding = '1rem 0';
                navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            }
        });
    </script>
@endpush
