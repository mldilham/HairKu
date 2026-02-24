<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Tambah <span class="text-primary-custom">Layanan</span></h2>
                    <p class="text-muted mb-0">Tambah layanan baru untuk barber Anda</p>
                </div>
                <a href="{{ route('barber.services.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="custom-card">
                        <form method="POST" action="{{ route('barber.services.store') }}">
                            @csrf

                            <!-- Service Name -->
                            <div class="mb-4">
                                <label for="service_name" class="form-label fw-bold">Nama Layanan</label>
                                <input type="text" class="form-control form-control-lg" id="service_name"
                                       name="service_name" value="{{ old('service_name') }}" required
                                       autofocus placeholder="Contoh: Potong rambut">
                                @error('service_name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label for="price" class="form-label fw-bold">Harga (Rp)</label>
                                <input type="number" class="form-control form-control-lg" id="price"
                                       name="price" value="{{ old('price') }}" required min="0"
                                       placeholder="Contoh: 25000">
                                @error('price')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div class="mb-4">
                                <label for="duration_minutes" class="form-label fw-bold">Durasi (menit)</label>
                                <input type="number" class="form-control form-control-lg" id="duration_minutes"
                                       name="duration_minutes" value="{{ old('duration_minutes') }}" required min="1"
                                       placeholder="Contoh: 30">
                                @error('duration_minutes')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('barber.services.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-lg me-2"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-2"></i> Simpan Layanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
