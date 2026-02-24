<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Riwayat <span class="text-primary-custom">Booking</span></h2>
                    <p class="text-muted mb-0">Kelola semua booking Anda di HairKu</p>
                </div>
                <a href="{{ route('user.bookings.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i> Booking Baru
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
            @endif

            @if(!$bookings || $bookings->isEmpty())
                <div class="custom-card text-center py-5">
                    <div class="service-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Belum Ada Booking</h4>
                    <p class="text-muted mb-4">Anda belum memiliki riwayat booking apapun.</p>
                    <a href="{{ route('barbers.index') }}" class="btn btn-primary">
                        <i class="bi bi-search me-2"></i> Cari Barber
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($bookings as $booking)
                        <div class="col-12">
                            <div class="custom-card">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        @if($booking->barber->photo)
                                            <img src="{{ asset('storage/' . $booking->barber->photo) }}"
                                                 alt="{{ $booking->barber->shop_name }}"
                                                 class="img-fluid rounded-3"
                                                 style="object-fit: cover; height: 80px; width: 100%;">
                                        @else
                                            <div class="bg-primary-custom rounded-3 d-flex align-items-center justify-content-center"
                                                 style="height: 80px; width: 100%;">
                                                <span class="text-white fw-bold" style="font-size: 1.5rem;">
                                                    {{ substr($booking->barber->shop_name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <h5 class="fw-bold mb-1">{{ $booking->barber->shop_name }}</h5>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-scissors me-1"></i> {{ $booking->service->service_name }}
                                        </p>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-geo-alt me-1"></i> {{ $booking->barber->address ?? 'Alamat tidak tersedia' }}
                                        </p>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <p class="mb-1"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</p>
                                        <p class="mb-0"><strong>Jam:</strong> {{ $booking->booking_time }}</p>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
                                        <div class="text-md-end">
                                            <p class="fw-bold text-primary-custom mb-1" style="font-size: 1.25rem;">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </p>
                                            @switch($booking->status)
                                                @case('pending')
                                                    <span class="badge badge-pending px-3 py-2 rounded-pill">Menunggu</span>
                                                    @break
                                                @case('accepted')
                                                    <span class="badge badge-accepted px-3 py-2 rounded-pill">Diterima</span>
                                                    @break
                                                @case('on_the_way')
                                                    <span class="badge badge-accepted px-3 py-2 rounded-pill">Dalam Perjalanan</span>
                                                    @break
                                                @case('completed')
                                                    <span class="badge badge-completed px-3 py-2 rounded-pill">Selesai</span>
                                                    @break
                                                @case('cancelled')
                                                    <span class="badge badge-cancelled px-3 py-2 rounded-pill">Dibatalkan</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $booking->status }}</span>
                                            @endswitch
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-3 mt-md-0 text-end">
                                        @if($booking->status === 'pending' || $booking->status === 'accepted')
                                            <form action="{{ route('user.bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'completed')
                                            @php
                                                $hasReview = \App\Models\Review::where('booking_id', $booking->id)->first();
                                            @endphp
                                            @if(!$hasReview)
                                                <a href="{{ route('user.reviews.create', $booking->id) }}" class="btn btn-outline-primary btn-sm" title="Beri Review">
                                                    <i class="bi bi-star"></i>
                                                </a>
                                            @else
                                                <span class="text-success" title="Sudah Direview">
                                                    <i class="bi bi-check-circle-fill fs-5"></i>
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
