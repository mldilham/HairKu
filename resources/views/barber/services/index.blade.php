<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Kelola <span class="text-primary-custom">Layanan</span></h2>
                    <p class="text-muted mb-0">{{ $barber->shop_name }}</p>
                </div>
                <a href="{{ route('barber.services.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Layanan
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($services->isEmpty())
                <div class="custom-card text-center py-5">
                    <div class="service-icon mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="bi bi-scissors"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Belum Ada Layanan</h4>
                    <p class="text-muted mb-3">Silakan tambah layanan pertama Anda!</p>
                    <a href="{{ route('barber.services.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i> Tambah Layanan
                    </a>
                </div>
            @else
                <div class="row g-4">
                    @foreach($services as $index => $service)
                        <div class="col-md-6 col-lg-4">
                            <div class="custom-card h-100">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary-custom bg-opacity-10 rounded-3 d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-scissors text-primary-custom"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold mb-0">{{ $service->service_name }}</h5>
                                            <span class="text-muted small">{{ $service->duration_minutes }} menit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted small">Harga</span>
                                        <p class="fw-bold text-primary-custom mb-0" style="font-size: 1.25rem;">
                                            Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('barber.services.edit', $service->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-pencil me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('barber.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
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
