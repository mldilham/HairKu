<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Booking <span class="text-primary-custom">Masuk</span></h2>
                    <p class="text-muted mb-0">{{ $barber->shop_name }}</p>
                </div>
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

            @if($bookings->isEmpty())
                <div class="custom-card text-center py-5">
                    <div class="service-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Belum Ada Booking</h4>
                    <p class="text-muted mb-0">Belum ada booking masuk saat ini.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach($bookings as $booking)
                        <div class="col-12">
                            <div class="custom-card">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <div class="bg-primary-custom rounded-3 d-flex align-items-center justify-content-center"
                                             style="height: 60px; width: 60px;">
                                            <span class="text-white fw-bold" style="font-size: 1.5rem;">
                                                {{ substr($booking->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3 mt-md-0">
                                        <h5 class="fw-bold mb-1">{{ $booking->user->name }}</h5>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-scissors me-1"></i> {{ $booking->service->service_name }}
                                        </p>
                                    </div>
                                    <div class="col-md-2 mt-3 mt-md-0">
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
                                    <div class="col-md-3 mt-3 mt-md-0 text-end">
                                        @if($booking->status === 'pending')
                                            <form action="{{ route('barber.bookings.accept', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Terima booking ini?')">
                                                    <i class="bi bi-check-lg me-1"></i> Terima
                                                </button>
                                            </form>
                                            <form action="{{ route('barber.bookings.reject', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tolak booking ini?')">
                                                    <i class="bi bi-x-lg me-1"></i> Tolak
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'accepted')
                                            <form action="{{ route('barber.bookings.onTheWay', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Tandai sedang berangkat?')">
                                                    <i class="bi bi-person-walking me-1"></i> Berangkat
                                                </button>
                                            </form>
                                            <form action="{{ route('barber.bookings.complete', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Tandai selesai?')">
                                                    <i class="bi bi-check-lg me-1"></i> Selesai
                                                </button>
                                            </form>
                                        @elseif($booking->status === 'on_the_way')
                                            <form action="{{ route('barber.bookings.complete', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Tandai selesai?')">
                                                    <i class="bi bi-check-lg me-1"></i> Selesai
                                                </button>
                                            </form>
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
