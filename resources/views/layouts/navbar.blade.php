<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/"
            style="color: #360185; font-size: 1.5rem;">
            <img src="{{ asset('images/Logo ALP Webdev.png') }}" alt="" width="45" height="45" class="me-2"
                style="object-fit: contain; border-radius: 10px; background: transparent; mix-blend-mode: multiply;">
            Festivo
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                @if (Auth::user()->role === 'eventManager' || Auth::user()->role === 'vendorManager')
                    {{-- Spacer to balance the navbar --}}
                    <div class="d-none d-lg-block" style="width: 120px;"></div>
                @endif
            @endauth

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                @auth
                    @if (Auth::user()->is_admin)
                        <!-- Admin menu -->
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/payments') ? 'active' : '' }}"
                                href="{{ route('admin.payments') }}">Payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}"
                                href="{{ route('admin.users') }}">Users</a>
                        </li>
                    @else
                        <!-- User authenticated menu -->
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}" href="/explore">Explore</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('events') ? 'active' : '' }}" href="/events">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('faq') ? 'active' : '' }}" href="/faq">FAQ</a>
                        </li>
                    @endif
                @else
                    <!-- Guest menu -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('explore') ? 'active' : '' }}" href="/explore">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('events') ? 'active' : '' }}" href="/events">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('faq') ? 'active' : '' }}" href="/faq">FAQ</a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex gap-2 align-items-center">
                @auth
                    {{-- Manage Events Button (Only for Event Managers) --}}
                    @if (Auth::user()->role === 'eventManager')
                        <a href="{{ route('event-manager.manage') }}"
                            class="btn btn-sm px-3 py-2 fw-semibold {{ Request::is('event-manager/manage') ? 'active' : '' }}"
                            style="background-color: #F4B342; color: #360185; border-radius: 8px; transition: all 0.3s ease; font-size: 0.9rem;"
                            onmouseover="this.style.backgroundColor='#360185'; this.style.color='white';"
                            onmouseout="this.style.backgroundColor='#F4B342'; this.style.color='#360185';">
                            <i class="bi bi-gear me-1"></i>Manage Events
                        </a>
                    @endif

                    {{-- Vendor Profile Button (Only for Vendor Managers) --}}
                    @if (Auth::user()->role === 'vendorManager')
                        <a href="{{ route('vendor.profile') }}"
                            class="btn btn-sm px-3 py-2 fw-semibold {{ Request::is('vendor/*') ? 'active' : '' }}"
                            style="background-color: #8F0177; color: white; border-radius: 8px; transition: all 0.3s ease; font-size: 0.9rem;"
                            onmouseover="this.style.backgroundColor='#DE1A58';"
                            onmouseout="this.style.backgroundColor='#8F0177';">
                            <i class="bi bi-shop me-1"></i>Vendor Profile
                        </a>
                    @endif

                    {{-- Bookings Icon (Only for regular users, not event managers or admins) --}}
                    @if (Auth::user()->role === 'user')
                        <a href="{{ route('bookings.index') }}"
                            class="btn btn-link position-relative p-2 navbar-cart-icon {{ Request::is('bookings*') ? 'active' : '' }}"
                            title="My Bookings">
                            <i class="bi bi-calendar-check fs-5" style="color: #360185;"></i>
                            @if (isset($bookingCount) && $bookingCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
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

                            {{-- Manage Events Link (Only for Event Managers) --}}
                            @if (Auth::user()->role === 'eventManager')
                                <li><a class="dropdown-item" href="{{ route('event-manager.manage') }}">
                                        <i class="bi bi-gear me-2"></i>Manage Events</a>
                                </li>
                            @endif

                            @if (!Auth::user()->is_admin)
                                <li><a class="dropdown-item" href="{{ route('bookings.index') }}">
                                        <i class="bi bi-calendar-check me-2"></i>My Bookings</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @else
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
