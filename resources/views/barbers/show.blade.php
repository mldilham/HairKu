<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('barbers.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Barber
                </a>
            </div>

            <!-- Barber Info Card -->
            <div class="custom-card mb-5">
                <div class="row">
                    <!-- Photo -->
                    <div class="col-md-4">
                        @if ($barber->photo)
                            <img src="{{ asset('storage/' . $barber->photo) }}"
                                 alt="{{ $barber->shop_name }}"
                                 class="img-fluid rounded-4"
                                 style="object-fit: cover; height: 300px; width: 100%;">
                        @else
                            <div class="rounded-4 d-flex align-items-center justify-content-center"
                                 style="height: 300px; width: 100%; background: linear-gradient(135deg, #F97316 0%, #FB923C 100%);">
                                <span class="text-white fw-bold" style="font-size: 5rem;">
                                    {{ substr($barber->shop_name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="col-md-8 mt-4 mt-md-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h2 class="fw-bold mb-1">{{ $barber->shop_name }}</h2>
                                <p class="text-muted mb-2">Pemilik: {{ $barber->user->name }}</p>
                            </div>
                            <div class="d-flex align-items-center bg-warning bg-opacity-10 px-4 py-2 rounded-pill">
                                <i class="bi bi-star-fill text-warning me-2"></i>
                                <span class="fw-bold">{{ number_format($barber->getAverageRating(), 1) }}</span>
                                <span class="text-muted ms-1">({{ $barber->getReviewCount() }} review)</span>
                            </div>
                        </div>

                        @if ($barber->address)
                            <p class="text-muted mt-3">
                                <i class="bi bi-geo-alt text-primary-custom me-2"></i>
                                {{ $barber->address }}
                            </p>
                        @endif

                        @if ($barber->description)
                            <p class="text-muted mt-3">{{ $barber->description }}</p>
                        @endif

                        <div class="mt-4">
                            @auth
                                @if (auth()->user()->role === 'user')
                                    <a href="#services" class="btn btn-primary">
                                        <i class="bi bi-calendar-check me-2"></i> Booking Sekarang
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right me-2"></i> Login untuk Booking
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services List -->
            <div id="services" class="mb-5">
                <h3 class="fw-bold mb-4">Daftar <span class="text-primary-custom">Layanan</span></h3>

                @if ($barber->services->isEmpty())
                    <div class="custom-card text-center py-4">
                        <p class="text-muted mb-0">Belum ada layanan tersedia untuk barber ini.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($barber->services as $service)
                            <div class="col-md-6">
                                <div class="custom-card h-100">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="fw-bold mb-1">{{ $service->service_name }}</h5>
                                            <p class="text-muted small mb-0">{{ $service->duration_minutes }} menit</p>
                                        </div>
                                        <div class="text-end">
                                            <p class="service-price mb-1">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                                            @auth
                                                @if (auth()->user()->role === 'user')
                                                    <a href="{{ route('user.bookings.create', ['barber' => $barber->id, 'service' => $service->id]) }}" class="btn btn-outline-primary btn-sm">
                                                        Book
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}" class="text-primary-custom small">Login</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- User's Review Section -->
            @if($userReview)
                <div class="mb-5">
                    <h3 class="fw-bold mb-4">Rating <span class="text-primary-custom">Anda</span></h3>
                    <div class="custom-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="reviewer-avatar me-3">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ auth()->user()->name }}</h6>
                                    <small class="text-muted">{{ $userReview->created_at->format('d/m/Y') }}</small>
                                </div>
                            </div>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $userReview->rating)
                                        <i class="bi bi-star-fill star-filled"></i>
                                    @else
                                        <i class="bi bi-star-fill star-empty"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        @if($userReview->comment)
                            <p class="text-muted mt-3 mb-0">{{ $userReview->comment }}</p>
                        @endif
                        <div class="mt-3 text-success small">
                            <i class="bi bi-check-circle me-1"></i> Terima kasih! Review Anda telah disimpan.
                        </div>
                    </div>
                </div>
            @endif

            <!-- All Reviews Section -->
            <div>
                <h3 class="fw-bold mb-4">Semua <span class="text-primary-custom">Ulasan</span> ({{ $barber->getReviewCount() }})</h3>

                @if ($barber->reviews->isEmpty())
                    <div class="custom-card text-center py-4">
                        <div class="service-icon mx-auto mb-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <p class="text-muted mb-0">Belum ada review untuk barber ini.</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach ($barber->reviews as $review)
                            <div class="col-md-6">
                                <div class="review-card h-100">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="reviewer-avatar me-3">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                                <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                            </div>
                                        </div>
                                        <div>
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <i class="bi bi-star-fill star-filled"></i>
                                                @else
                                                    <i class="bi bi-star-fill star-empty"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    @if ($review->comment)
                                        <p class="text-muted mb-0">{{ $review->comment }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
