<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/" style="color: #360185; font-size: 1.5rem;">
            <img src="{{ asset('images/logo.png') }}" alt="" width="45" height="45" class="me-2"
                style="object-fit: contain;">
            Festivo
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->is_admin)
                        <!-- Admin menu -->
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                                href="/admin/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/vendors') ? 'active' : '' }}"
                                href="/admin/vendors">Vendors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/bookings') ? 'active' : '' }}"
                                href="/admin/bookings">Bookings</a>
                        </li>
                    @else
                        <!-- User authenticated menu -->
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                                href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}"
                                href="/explore">Explore</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" 
                                href="#" id="servicesDropdown" role="button" 
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                                <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="servicesDropdown">
                                <li><a class="dropdown-item" href="/vendors?category=conference">Conference</a></li>
                                <li><a class="dropdown-item" href="/vendors?category=concert">Concert & Music</a></li>
                                <li><a class="dropdown-item" href="/vendors?category=wedding">Wedding</a></li>
                                <li><a class="dropdown-item" href="/vendors?category=festival">Festival</a></li>
                                <li><a class="dropdown-item" href="/vendors?category=corporate">Corporate Event</a></li>
                                <li><a class="dropdown-item" href="/vendors?category=exhibition">Exhibition</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fw-semibold" href="/vendors">All Services</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('faq') ? 'active' : '' }}"
                                href="/faq">FAQ</a>
                        </li>
                    @endif
                @else
                    <!-- Guest menu -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}"
                            href="/explore">Explore</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" 
                            href="#" id="servicesDropdown" role="button" 
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                            <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem;"></i>
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="/vendors?category=conference">Conference</a></li>
                            <li><a class="dropdown-item" href="/vendors?category=concert">Concert & Music</a></li>
                            <li><a class="dropdown-item" href="/vendors?category=wedding">Wedding</a></li>
                            <li><a class="dropdown-item" href="/vendors?category=festival">Festival</a></li>
                            <li><a class="dropdown-item" href="/vendors?category=corporate">Corporate Event</a></li>
                            <li><a class="dropdown-item" href="/vendors?category=exhibition">Exhibition</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item fw-semibold" href="/vendors">All Services</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('faq') ? 'active' : '' }}"
                            href="/faq">FAQ</a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex gap-2 align-items-center">
                @auth
                    {{-- Bookings Icon (Only for non-admin users) --}}
                    @if (!Auth::user()->is_admin)
                        <a href="{{ route('bookings.index') }}"
                            class="btn btn-link position-relative p-2 navbar-cart-icon {{ Request::is('bookings*') ? 'active' : '' }}"
                            title="My Bookings">
                            <i class="bi bi-calendar-check fs-5" style="color: #360185;"></i>
                            @if (isset($bookingCount) && $bookingCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $bookingCount > 99 ? '99+' : $bookingCount }}
                                    <span class="visually-hidden">active bookings</span>
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
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm" aria-labelledby="userDropdown">
                            {{-- Profile Link for All Users --}}
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i>My Profile</a>
                            </li>
                            
                            @if (!Auth::user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('bookings.index') }}">
                                    <i class="bi bi-calendar-event me-2"></i>My Bookings</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @else
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-logout">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-shop-now">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>