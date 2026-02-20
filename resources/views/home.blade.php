<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="HairKu - Aplikasi Booking Potong Rambut">
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
        }

        .text-primary-custom {
            color: var(--primary-orange) !important;
        }

        .bg-primary-custom {
            background-color: var(--primary-orange) !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #FFFFFF 0%, #FFF7ED 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--text-muted);
            font-weight: 400;
        }

        .badge-custom {
            background-color: #FFF7ED;
            color: var(--primary-orange);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .badge-custom::before {
            content: '';
            width: 8px;
            height: 8px;
            background-color: var(--primary-orange);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Card Styles */
        .service-card {
            background: var(--white);
            border: none;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 64px;
            height: 64px;
            background-color: #FFF7ED;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: var(--primary-orange);
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            background-color: var(--primary-orange);
            color: white;
        }

        .service-price {
            color: var(--primary-orange);
            font-weight: 700;
            font-size: 1.125rem;
        }

        /* Barber Card */
        .barber-card {
            background: var(--white);
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .barber-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .barber-img {
            height: 220px;
            object-fit: cover;
            width: 100%;
        }

        .barber-img-placeholder {
            height: 220px;
            background: linear-gradient(135deg, #F97316 0%, #FB923C 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .barber-img-placeholder span {
            font-size: 4rem;
            font-weight: 800;
            color: white;
        }

        .rating-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.95);
            padding: 6px 12px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Review Card */
        .review-card {
            background: var(--white);
            border: none;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .reviewer-avatar {
            width: 48px;
            height: 48px;
            background-color: #FFF7ED;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-orange);
            font-weight: 700;
        }

        .star-filled {
            color: #FBBF24;
        }

        .star-empty {
            color: #D1D5DB;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, #F97316 0%, #FB923C 100%);
            padding: 80px 0;
        }

        /* Section Titles */
        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 1.125rem;
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
        }

        .nav-link-custom:hover {
            color: var(--primary-orange);
            background-color: #FFF7ED;
        }

        /* Footer */
        .footer {
            background-color: #111827;
            color: white;
            padding: 60px 0 30px;
        }

        .footer-link {
            color: #9CA3AF;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--primary-orange);
        }

        /* Stats */
        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
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
                        <a class="nav-link nav-link-custom" href="#services">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#barbers">Barber</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="#reviews">Ulasan</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    @auth
                        @if(Auth::user()->role === 'user')
                            <a href="{{ route('user.dashboard') }}" class="nav-link-custom text-decoration-none">
                                <i class="bi bi-person-circle me-1"></i> Dashboard
                            </a>
                        @elseif(Auth::user()->role === 'barber')
                            <a href="{{ route('barber.dashboard') }}" class="nav-link-custom text-decoration-none">
                                <i class="bi bi-person-circle me-1"></i> Dashboard
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link-custom text-decoration-none bg-transparent border-0">
                                <i class="bi bi-box-arrow-right me-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-link-custom text-decoration-none">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="badge-custom mb-4">
                        Booking Mudah & Praktis
                    </div>

                    <h1 class="hero-title mb-4">
                        Tampilan Baru,<br>
                        <span class="text-primary-custom">Percaya Diri Baru</span>
                    </h1>

                    <p class="hero-subtitle mb-4">
                        Dapatkan potongan rambut sempurna dari barber terbaik.
                        Booking online mudah, praktis, dan tanpa antre.
                        Waktunya tampil lebih baik!
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('barbers.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-calendar-check me-2"></i> Book Now
                        </a>
                        <a href="#barbers" class="btn btn-outline-primary btn-lg">
                            Lihat Barber
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="row mt-5 pt-4 border-top border-light">
                        <div class="col-4 stat-item">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Barber Professional</div>
                        </div>
                        <div class="col-4 stat-item">
                            <div class="stat-number">10.000+</div>
                            <div class="stat-label">Pelanggan Puas</div>
                        </div>
                        <div class="col-4 stat-item">
                            <div class="stat-number">4.9</div>
                            <div class="stat-label">Rating Rata-rata</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mt-5 mt-lg-0">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="Barbershop"
                             class="img-fluid rounded-4 shadow-lg"
                             style="object-fit: cover; height: 450px; width: 100%;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4">
                            <div class="bg-white rounded-3 p-3 shadow-lg d-inline-flex align-items-center gap-3">
                                <div class="bg-primary-custom rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-check-lg text-white fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Booking Confirmed</div>
                                    <div class="small text-muted">Tanpa antre lagi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="section-title mb-3">
                    Layanan <span class="text-primary-custom">Kami</span>
                </h2>
                <p class="section-subtitle mx-auto" style="max-width: 600px;">
                    Berbagai layanan potong rambut dan perawatan untuk pria agar selalu tampil optimal
                </p>
            </div>

            <div class="row g-4">
                <!-- Haircut -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card h-100">
                        <div class="service-icon mb-3">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Haircut</h5>
                        <p class="text-muted small mb-3">Potong rambut dengan berbagai model sesuai tren terkini</p>
                        <div class="service-price">
                            Mulai Rp 30.000
                        </div>
                    </div>
                </div>

                <!-- Hair Coloring -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card h-100">
                        <div class="service-icon mb-3">
                            <i class="bi bi-palette"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Hair Coloring</h5>
                        <p class="text-muted small mb-3">Warna rambut sesuai keinginan dengan produk berkualitas</p>
                        <div class="service-price">
                            Mulai Rp 100.000
                        </div>
                    </div>
                </div>

                <!-- Beard Trim -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card h-100">
                        <div class="service-icon mb-3">
                            <i class="bi bi-brush"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Beard Trim</h5>
                        <p class="text-muted small mb-3">Rapikan jenggot dan kumis dengan desain menarik</p>
                        <div class="service-price">
                            Mulai Rp 25.000
                        </div>
                    </div>
                </div>

                <!-- Styling -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-card h-100">
                        <div class="service-icon mb-3">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Styling</h5>
                        <p class="text-muted small mb-3">Styling rambut untuk acara khusus atau harian</p>
                        <div class="service-price">
                            Mulai Rp 35.000
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Barbers Section -->
    @if($topBarbers->isNotEmpty())
        <section id="barbers" class="py-5">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="section-title mb-3">
                        Barber <span class="text-primary-custom">Terbaik</span>
                    </h2>
                    <p class="section-subtitle mx-auto" style="max-width: 600px;">
                        Temukan barber profesional dengan rating tertinggi di sekitar Anda
                    </p>
                </div>

                <div class="row g-4">
                    @foreach($topBarbers as $barber)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('barbers.show', $barber->id) }}" class="text-decoration-none">
                                <div class="barber-card h-100">
                                    <div class="position-relative">
                                        @if($barber->photo)
                                            <img src="{{ asset('storage/' . $barber->photo) }}"
                                                 alt="{{ $barber->shop_name }}"
                                                 class="barber-img">
                                        @else
                                            <div class="barber-img-placeholder">
                                                <span>{{ substr($barber->shop_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="rating-badge">
                                            <i class="bi bi-star-fill star-filled"></i>
                                            {{ number_format($barber->getAverageRating(), 1) }}
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <h5 class="fw-bold mb-1 text-dark">{{ $barber->shop_name }}</h5>
                                        <p class="text-muted small mb-2">{{ $barber->user->name }}</p>

                                        @if($barber->address)
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-geo-alt me-1"></i>
                                                {{ Str::limit($barber->address, 40) }}
                                            </p>
                                        @endif

                                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                            <div class="small text-muted">
                                                <i class="bi bi-chat-dots me-1"></i>
                                                {{ $barber->getReviewCount() }} review
                                            </div>
                                            @if($barber->services->isNotEmpty())
                                                <div class="text-primary-custom fw-bold">
                                                    Rp {{ number_format($barber->services->min('price'), 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-3">
                                            <span class="btn btn-outline-primary w-100 btn-sm">
                                                Lihat Detail
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('barbers.index') }}" class="btn btn-outline-primary">
                        Lihat Semua Barber
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Reviews Section -->
    @if($recentReviews->isNotEmpty())
        <section id="reviews" class="py-5" style="background-color: var(--light-bg);">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="section-title mb-3">
                        Ulasan <span class="text-primary-custom">Pelanggan</span>
                    </h2>
                    <p class="section-subtitle mx-auto" style="max-width: 600px;">
                        Apa kata pelanggan tentang pengalaman mereka di HairKu
                    </p>
                </div>

                <div class="row g-4">
                    @foreach($recentReviews as $review)
                        <div class="col-md-6 col-lg-4">
                            <div class="review-card h-100">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="reviewer-avatar">
                                            {{ substr($review->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                            <small class="text-muted">{{ $review->barber->shop_name }}</small>
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                                </div>

                                <div class="mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="bi bi-star-fill star-filled"></i>
                                        @else
                                            <i class="bi bi-star-fill star-empty"></i>
                                        @endif
                                    @endfor
                                </div>

                                @if($review->comment)
                                    <p class="text-muted mb-0">{{ $review->comment }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center py-5">
            <h2 class="text-white fw-bold mb-3" style="font-size: 2.5rem;">
                Siap Tampilan Baru?
            </h2>
            <p class="text-white mb-4 mx-auto" style="max-width: 600px; font-size: 1.125rem; opacity: 0.9;">
                Booking sekarang dan rasakan pengalaman potong rambut yang berbeda
            </p>
            <a href="{{ route('barbers.index') }}" class="btn btn-light btn-lg text-primary-custom fw-bold">
                <i class="bi bi-calendar-check me-2"></i> Book Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
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
                        <li class="mb-2"><a href="#services" class="footer-link">Layanan</a></li>
                        <li class="mb-2"><a href="#reviews" class="footer-link">Ulasan</a></li>
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

            <div class="mt-5 pt-4 border-top border-secondary text-center">
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
