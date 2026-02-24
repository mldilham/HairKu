<x-app-layout>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="badge-custom mb-4">
                        Dashboard Pelanggan
                    </div>

                    <h1 class="hero-title mb-4">
                        Halo, <span class="text-primary-custom">{{ Auth::user()->name }}</span>!
                    </h1>

                    <p class="hero-subtitle mb-4">
                        Selamat datang di HairKu! Temukan barber profesional terdekat dan booking sekarang untuk tampilan yang lebih percaya diri.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('barbers.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-calendar-check me-2"></i> Booking Sekarang
                        </a>
                        <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-clock-history me-2"></i> Lihat Riwayat
                        </a>
                    </div>
                </div>

                <div class="col-lg-5 mt-5 mt-lg-0">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             alt="Barbershop"
                             class="img-fluid rounded-4 shadow-lg"
                             style="object-fit: cover; height: 350px; width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="custom-card text-center h-100">
                        <div class="service-icon mb-3 mx-auto">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3 class="fw-bold text-primary-custom">{{ $bookings ? $bookings->count() : 0 }}</h3>
                        <p class="text-muted mb-0">Total Booking</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card text-center h-100">
                        <div class="service-icon mb-3 mx-auto">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h3 class="fw-bold text-primary-custom">{{ $bookings ? $bookings->where('status', 'completed')->count() : 0 }}</h3>
                        <p class="text-muted mb-0">Booking Selesai</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card text-center h-100">
                        <div class="service-icon mb-3 mx-auto">
                            <i class="bi bi-star"></i>
                        </div>
                        <h3 class="fw-bold text-primary-custom">{{ $bookings ? $bookings->where('status', 'completed')->count() : 0 }}</h3>
                        <p class="text-muted mb-0">Review Diberikan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Actions -->
    <section class="py-5">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="section-title mb-3">
                    Akses <span class="text-primary-custom">Cepat</span>
                </h2>
                <p class="section-subtitle mx-auto" style="max-width: 600px;">
                    Navigasi cepat ke fitur utama aplikasi HairKu
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('barbers.index') }}" class="text-decoration-none">
                        <div class="custom-card h-100 text-center">
                            <div class="service-icon mb-3 mx-auto">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Cari Barber</h5>
                            <p class="text-muted small mb-0">Temukan barber profesional terdekat</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('user.bookings.create') }}" class="text-decoration-none">
                        <div class="custom-card h-100 text-center">
                            <div class="service-icon mb-3 mx-auto">
                                <i class="bi bi-calendar-plus"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Booking Baru</h5>
                            <p class="text-muted small mb-0">Buat booking potong rambut</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('user.bookings.index') }}" class="text-decoration-none">
                        <div class="custom-card h-100 text-center">
                            <div class="service-icon mb-3 mx-auto">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Riwayat Booking</h5>
                            <p class="text-muted small mb-0">Lihat riwayat booking Anda</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('home') }}#reviews" class="text-decoration-none">
                        <div class="custom-card h-100 text-center">
                            <div class="service-icon mb-3 mx-auto">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Lihat Ulasan</h5>
                            <p class="text-muted small mb-0">Baca ulasan dari pelanggan lain</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container text-center py-5">
            <h2 class="text-white fw-bold mb-3" style="font-size: 2rem;">
                Siap Tampilan Baru?
            </h2>
            <p class="text-white mb-4 mx-auto" style="max-width: 500px; opacity: 0.9;">
                Booking sekarang dan rasakan pengalaman potong rambut yang berbeda
            </p>
            <a href="{{ route('barbers.index') }}" class="btn btn-light btn-lg text-primary-custom fw-bold">
                <i class="bi bi-calendar-check me-2"></i> Booking Sekarang
            </a>
        </div>
    </section>
</x-app-layout>
