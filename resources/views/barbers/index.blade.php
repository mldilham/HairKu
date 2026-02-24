<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="text-center mb-5">
                <h2 class="section-title mb-3">
                    Barber <span class="text-primary-custom">Terbaik</span>
                </h2>
                <p class="section-subtitle mx-auto" style="max-width: 600px;">
                    Temukan barber profesional dengan rating tertinggi di sekitar Anda
                </p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('barbers.index') }}" class="mb-5">
                <div class="row g-3 justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text"
                                   name="search"
                                   value="{{ $search ?? '' }}"
                                   placeholder="Cari barber..."
                                   class="form-control border-start-0 ps-0">
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-search me-2"></i>Cari
                        </button>
                        @if($search)
                            <a href="{{ route('barbers.index') }}" class="btn btn-outline-secondary btn-lg">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            @if ($barbers->isEmpty())
                <div class="custom-card text-center py-5">
                    <div class="service-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-shop"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Belum Ada Barber</h4>
                    <p class="text-muted mb-4">Belum ada barber yang tersedia saat ini.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($barbers as $barber)
                        <div class="col-md-6 col-lg-4">
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

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $barbers->links() }}
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
