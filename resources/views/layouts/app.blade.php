<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HairKu') }}</title>

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-orange: #F97316;
            --primary-orange-hover: #EA580C;
            --light-bg: #F8F9FA;
            --white: #FFFFFF;
            --text-dark: #1F2937;
            --text-muted: #6B7280;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
        }

        .btn-primary {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-orange-hover);
            border-color: var(--primary-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);
        }

        .btn-outline-primary {
            color: var(--primary-orange);
            border-color: var(--primary-orange);
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 8px;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
            color: white;
        }

        .text-primary-custom {
            color: var(--primary-orange) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-orange) !important;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.04);
        }

        .nav-link-custom {
            color: var(--text-dark);
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-link-custom:hover {
            color: var(--primary-orange);
            background-color: #FFF7ED;
        }

        /* Card Styles */
        .custom-card {
            background: var(--white);
            border: none;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .custom-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        .footer {
            background-color: #111827;
            color: white;
            padding: 40px 0 20px;
        }

        .footer-link {
            color: #9CA3AF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary-orange);
        }

        /* Section Title */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Page Content */
        .page-content {
            padding: 80px 0;
            min-height: calc(100vh - 200px);
        }

        /* Form Styles */
        .form-control:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25);
        }

        .form-select:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 0.2rem rgba(249, 115, 22, 0.25);
        }

        /* Badge Styles */
        .badge-pending {
            background-color: #FEF3C7;
            color: #D97706;
        }

        .badge-accepted {
            background-color: #DBEAFE;
            color: #2563EB;
        }

        .badge-completed {
            background-color: #D1FAE5;
            color: #059669;
        }

        .badge-cancelled {
            background-color: #FEE2E2;
            color: #DC2626;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="bg-primary-custom rounded-2 d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                    <i class="bi bi-scissors text-white"></i>
                </div>
                <span class="fw-bold fs-4">HairKu</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('barbers.index') }}">
                            <i class="bi bi-shop me-1"></i> Barber
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->role === 'user')
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="{{ route('user.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="{{ route('user.bookings.index') }}">
                                    <i class="bi bi-calendar-check me-1"></i> Booking
                                </a>
                            </li>
                        @elseif(Auth::user()->role === 'barber')
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="{{ route('barber.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="{{ route('barber.bookings.index') }}">
                                    <i class="bi bi-calendar-check me-1"></i> Booking
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{ route('home') }}#services">Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{ route('home') }}#reviews">Ulasan</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @auth
                        @if(Auth::user()->role === 'user')
                            <a href="{{ route('user.dashboard') }}" class="nav-link-custom">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                        @elseif(Auth::user()->role === 'barber')
                            <a href="{{ route('barber.dashboard') }}" class="nav-link-custom">
                                <i class="bi bi-person-circle me-1"></i> Dashboard
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link-custom bg-transparent border-0">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link-custom">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary-custom rounded-2 d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                            <i class="bi bi-scissors text-white"></i>
                        </div>
                        <span class="fw-bold fs-4">HairKu</span>
                    </div>
                    <p class="text-secondary mb-0" style="max-width: 300px;">
                        Aplikasi booking potong rambut terbaik di Indonesia. Temukan barber profesional dan booking dengan mudah.
                    </p>
                </div>

                <div class="col-6 col-lg-3">
                    <h6 class="fw-bold mb-4">Tautan Cepat</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="{{ route('barbers.index') }}" class="footer-link">Cari Barber</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#services" class="footer-link">Layanan</a></li>
                        <li class="mb-2"><a href="{{ route('home') }}#reviews" class="footer-link">Ulasan</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6 class="fw-bold mb-4">Kontak</h6>
                    <ul class="list-unstyled mb-0 text-secondary">
                        <li class="mb-2">info@hairku.id</li>
                        <li class="mb-2">+62 812 3456 7890</li>
                    </ul>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top border-secondary text-center">
                <p class="text-secondary mb-0">
                    &copy; {{ date('Y') }} HairKu. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
