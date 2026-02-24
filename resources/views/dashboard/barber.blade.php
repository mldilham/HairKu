<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Welcome Section -->
            <div class="custom-card mb-5" style="background: linear-gradient(135deg, #F97316 0%, #FB923C 100%);">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="fw-bold text-white mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                        <p class="text-white mb-0" style="opacity: 0.9;">Kelola barber shop Anda dengan mudah</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="bg-white rounded-3 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="bi bi-scissors text-primary-custom" style="font-size: 2.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="custom-card text-center h-100">
                        <div class="service-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 1.75rem;">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3 class="fw-bold mb-1">
                            @php
                                $barber = \App\Models\Barber::where('user_id', Auth::id())->first();
                                $pendingBookings = $barber ? \App\Models\Booking::where('barber_id', $barber->id)->where('status', 'pending')->count() : 0;
                            @endphp
                            {{ $pendingBookings }}
                        </h3>
                        <p class="text-muted mb-0">Booking Menunggu</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card text-center h-100">
                        <div class="service-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 1.75rem;">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h3 class="fw-bold mb-1">
                            @php
                                $acceptedBookings = $barber ? \App\Models\Booking::where('barber_id', $barber->id)->where('status', 'accepted')->count() : 0;
                            @endphp
                            {{ $acceptedBookings }}
                        </h3>
                        <p class="text-muted mb-0">Booking Diterima</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card text-center h-100">
                        <div class="service-icon mx-auto mb-3" style="width: 70px; height: 70px; font-size: 1.75rem;">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <h3 class="fw-bold mb-1">
                            @php
                                $serviceCount = $barber ? $barber->services->count() : 0;
                            @endphp
                            {{ $serviceCount }}
                        </h3>
                        <p class="text-muted mb-0">Layanan Tersedia</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h3 class="fw-bold mb-4">Akses <span class="text-primary-custom">Cepat</span></h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="custom-card h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-custom bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-calendar-plus text-primary-custom" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">Kelola Booking</h5>
                                <p class="text-muted mb-0 small">Terima dan kelola pesanan dari customer</p>
                            </div>
                        </div>
                        <a href="{{ route('barber.bookings.index') }}" class="btn btn-primary w-100">
                            <i class="bi bi-arrow-right me-2"></i> Lihat Booking
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-card h-100">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary-custom bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-list-ul text-primary-custom" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">Kelola Layanan</h5>
                                <p class="text-muted mb-0 small">Tambah, edit, atau hapus layanan barber</p>
                            </div>
                        </div>
                        <a href="{{ route('barber.services.index') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-arrow-right me-2"></i> Kelola Layanan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            @if($barber && $barber->bookings->isNotEmpty())
                <div class="mt-5">
                    <h3 class="fw-bold mb-4">Booking <span class="text-primary-custom">Terbaru</span></h3>
                    <div class="custom-card">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-0">Customer</th>
                                        <th class="border-0">Layanan</th>
                                        <th class="border-0">Tanggal</th>
                                        <th class="border-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($barber->bookings->take(5) as $booking)
                                        <tr>
                                            <td class="fw-bold">{{ $booking->user->name }}</td>
                                            <td>{{ $booking->service->service_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @switch($booking->status)
                                                    @case('pending')
                                                        <span class="badge badge-pending px-3 py-2 rounded-pill">Menunggu</span>
                                                        @break
                                                    @case('accepted')
                                                        <span class="badge badge-accepted px-3 py-2 rounded-pill">Diterima</span>
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
