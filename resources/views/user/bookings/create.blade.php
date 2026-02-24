<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Booking <span class="text-primary-custom">Baru</span></h2>
                    <p class="text-muted mb-0">Pilih barber dan layanan untuk melakukan booking</p>
                </div>
                <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="custom-card">
                        <form method="POST" action="{{ route('user.bookings.store') }}">
                            @csrf

                            <!-- Barber Selection -->
                            <div class="mb-4">
                                <label for="barber_id" class="form-label fw-bold">
                                    <i class="bi bi-shop me-2 text-primary-custom"></i>Pilih Barber
                                </label>
                                <select id="barber_id" name="barber_id" class="form-select form-select-lg" required>
                                    <option value="" disabled selected>Pilih barber...</option>
                                    @foreach($barbers as $barber)
                                        <option value="{{ $barber->id }}">{{ $barber->shop_name }} ({{ $barber->user->name }})</option>
                                    @endforeach
                                </select>
                                @error('barber_id')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Selection -->
                            <div class="mb-4">
                                <label for="service_id" class="form-label fw-bold">
                                    <i class="bi bi-scissors me-2 text-primary-custom"></i>Pilih Layanan
                                </label>
                                <select id="service_id" name="service_id" class="form-select form-select-lg" required>
                                    <option value="" disabled selected>Pilih layanan...</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}" data-duration="{{ $service->duration_minutes }}">
                                            {{ $service->service_name }} - Rp {{ number_format($service->price, 0, ',', '.') }} ({{ $service->duration_minutes }} menit)
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Booking Date -->
                            <div class="mb-4">
                                <label for="booking_date" class="form-label fw-bold">
                                    <i class="bi bi-calendar me-2 text-primary-custom"></i>Tanggal Booking
                                </label>
                                <input type="date"
                                       id="booking_date"
                                       name="booking_date"
                                       class="form-control form-control-lg"
                                       value="{{ old('booking_date') }}"
                                       required
                                       min="{{ date('Y-m-d') }}">
                                @error('booking_date')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Booking Time -->
                            <div class="mb-4">
                                <label for="booking_time" class="form-label fw-bold">
                                    <i class="bi bi-clock me-2 text-primary-custom"></i>Jam Booking
                                </label>
                                <input type="time"
                                       id="booking_time"
                                       name="booking_time"
                                       class="form-control form-control-lg"
                                       value="{{ old('booking_time') }}"
                                       required>
                                @error('booking_time')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-3 mt-4">
                                <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-secondary btn-lg">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1">
                                    <i class="bi bi-check-circle me-2"></i> Booking Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="custom-card">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-info-circle me-2 text-primary-custom"></i>Informasi Booking
                        </h5>
                        <div class="d-flex align-items-center mb-3">
                            <div class="service-icon" style="width: 48px; height: 48px;">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0 text-muted small">Tanpa Antri</p>
                                <p class="mb-0 fw-bold">Booking Online</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="service-icon" style="width: 48px; height: 48px;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0 text-muted small">Garansi</p>
                                <p class="mb-0 fw-bold">100% Uang Kembali</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="service-icon" style="width: 48px; height: 48px;">
                                <i class="bi bi-headset"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0 text-muted small">Bantuan</p>
                                <p class="mb-0 fw-bold">24/7 Customer Service</p>
                            </div>
                        </div>
                    </div>

                    <div class="custom-card mt-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-telephone me-2 text-primary-custom"></i>Butuh Bantuan?
                        </h5>
                        <p class="text-muted small mb-3">Hubungi kami jika Anda membutuhkan bantuan dalam melakukan booking.</p>
                        <a href="#" class="btn btn-outline-primary w-100">
                            <i class="bi bi-chat-dots me-2"></i> Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
