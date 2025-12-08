<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="/" style="color: #173648;">
            <img src="{{ asset('images/logo.png') }}" alt="" width="60" height="60" class="me-2"
                style="object-fit: contain;">
            Festivo
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                                href="/admin/dashboard">Dasbor Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('admin/vendors') ? 'active' : '' }}"
                                href="/admin/vendors">Kelola Vendor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('admin/bookings') ? 'active' : '' }}"
                                href="/admin/bookings">Pemesanan</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('/') ? 'active' : '' }}"
                                href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('vendors*') ? 'active' : '' }}"
                                href="/vendors">Vendor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('events') ? 'active' : '' }}"
                                href="/events">Event</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium text-dark px-2 {{ Request::is('contact') ? 'active' : '' }}"
                                href="/contact">Kontak</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-dark px-2 {{ Request::is('/') ? 'active' : '' }}"
                            href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-dark px-2 {{ Request::is('vendors*') ? 'active' : '' }}"
                            href="/vendors">Vendor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-dark px-2 {{ Request::is('events') ? 'active' : '' }}"
                            href="/events">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium text-dark px-2 {{ Request::is('contact') ? 'active' : '' }}"
                            href="/contact">Kontak</a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex gap-2 ms-lg-3 align-items-center">
                @auth
                    {{-- Bookings Icon (Only for non-admin users) --}}
                    @if (!Auth::user()->is_admin)
                        <a href="{{ route('bookings.index') }}"
                            class="btn btn-link position-relative p-2 navbar-cart-icon {{ Request::is('bookings*') ? 'active' : '' }}"
                            title="Pemesanan Saya">
                            <i class="bi bi-calendar-check fs-4" style="color: #173648;"></i>
                            @if (isset($bookingCount) && $bookingCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $bookingCount > 99 ? '99+' : $bookingCount }}
                                    <span class="visually-hidden">pemesanan aktif</span>
                                </span>
                            @endif
                        </a>
                    @endif

                    {{-- User Dropdown --}}
                    <div class="dropdown">
                        <button class="btn btn-custom-primary dropdown-toggle d-flex align-items-center" type="button"
                            id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if (!Auth::user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('bookings.index') }}"><i
                                            class="bi bi-calendar-event me-2"></i>Pemesanan Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('account.change-password') }}"><i
                                            class="bi bi-shield-lock me-2"></i>Ubah Kata Sandi</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-logout">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-custom-primary">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
