<x-app-layout>
    <section class="py-5" style="background-color: var(--light-bg);">
        <div class="container py-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Beri <span class="text-primary-custom">Review</span></h2>
                    <p class="text-muted mb-0">Bagikan pengalaman Anda setelah menggunakan layanan kami</p>
                </div>
                <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i> Kembali
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="custom-card">
                        <!-- Info Booking -->
                        <div class="mb-4 p-4 rounded-3" style="background-color: #FFF7ED;">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    @if($barber->photo)
                                        <img src="{{ asset('storage/' . $barber->photo) }}"
                                             alt="{{ $barber->shop_name }}"
                                             class="img-fluid rounded-3"
                                             style="object-fit: cover; height: 60px; width: 100%;">
                                    @else
                                        <div class="bg-primary-custom rounded-3 d-flex align-items-center justify-content-center"
                                             style="height: 60px; width: 100%;">
                                            <span class="text-white fw-bold">{{ substr($barber->shop_name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-10 mt-3 mt-md-0">
                                    <h5 class="fw-bold mb-1">{{ $barber->shop_name }}</h5>
                                    <p class="text-muted mb-0 small">
                                        <i class="bi bi-scissors me-1"></i> {{ $booking->service->service_name }} &bull;
                                        <i class="bi bi-calendar me-1"></i> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }} &bull;
                                        <i class="bi bi-clock me-1"></i> {{ $booking->booking_time }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('user.reviews.store') }}">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                            <!-- Rating -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-star me-2 text-primary-custom"></i>Rating
                                </label>
                                <div class="d-flex gap-2" id="star-container">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                                class="btn star-btn"
                                                data-rating="{{ $i }}"
                                                onmouseenter="highlightStars({{ $i }})"
                                                onmouseleave="resetStars()"
                                                onclick="selectStar({{ $i }})">
                                            <i class="bi bi-star star-icon fs-1"></i>
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating-input" value="">
                                <div class="mt-2">
                                    <span id="rating-text" class="text-muted">Klik bintang untuk rating</span>
                                </div>
                                @error('rating')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Comment -->
                            <div class="mb-4">
                                <label for="comment" class="form-label fw-bold">
                                    <i class="bi bi-chat-dots me-2 text-primary-custom"></i>Komentar (Opsional)
                                </label>
                                <textarea name="comment"
                                          id="comment"
                                          rows="5"
                                          class="form-control"
                                          placeholder="Tulis pengalaman Anda...">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-3 mt-4">
                                <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-secondary btn-lg">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg flex-grow-1">
                                    <i class="bi bi-send me-2"></i> Kirim Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="custom-card">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-lightbulb me-2 text-primary-custom"></i>Tips Review
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-primary-custom me-2"></i>
                                <span class="text-muted">Jelaskan pengalaman Anda secara detail</span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-primary-custom me-2"></i>
                                <span class="text-muted">Sebutkan hal yang Anda suka</span>
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-check-circle text-primary-custom me-2"></i>
                                <span class="text-muted">Berikan saran untuk perbaikan</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle text-primary-custom me-2"></i>
                                <span class="text-muted">Jujur dan objektif dalam penilaian</span>
                            </li>
                        </ul>
                    </div>

                    <div class="custom-card mt-4">
                        <h5 class="fw-bold mb-3">
                            <i class="bi bi-gift me-2 text-primary-custom"></i>Terima Kasih!
                        </h5>
                        <p class="text-muted small mb-0">
                            Terima kasih telah menggunakan layanan HairKu. Review Anda membantu kami meningkatkan kualitas layanan kami.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const ratingLabels = {
            1: '1 - Buruk',
            2: '2 - Kurang',
            3: '3 - Cukup',
            4: '4 - Bagus',
            5: '5 - Sangat Bagus'
        };

        let selectedRating = 0;

        function highlightStars(rating) {
            const stars = document.querySelectorAll('.star-icon');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-muted', 'text-warning');
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-muted');
                }
            });

            const ratingText = document.getElementById('rating-text');
            ratingText.textContent = ratingLabels[rating];
            ratingText.classList.remove('text-muted');
            ratingText.classList.add('text-warning', 'fw-bold');
        }

        function resetStars() {
            const stars = document.querySelectorAll('.star-icon');
            stars.forEach((star, index) => {
                if (selectedRating > 0 && index < selectedRating) {
                    star.classList.remove('text-muted');
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-muted');
                }
            });

            const ratingText = document.getElementById('rating-text');
            if (selectedRating > 0) {
                ratingText.textContent = '✓ ' + ratingLabels[selectedRating];
                ratingText.classList.remove('text-muted');
                ratingText.classList.add('text-success', 'fw-bold');
            } else {
                ratingText.textContent = 'Klik bintang untuk rating';
                ratingText.classList.remove('text-warning', 'text-success', 'fw-bold');
                ratingText.classList.add('text-muted');
            }
        }

        function selectStar(rating) {
            selectedRating = rating;

            // Update hidden input
            document.getElementById('rating-input').value = rating;

            // Update UI
            highlightStars(rating);

            const ratingText = document.getElementById('rating-text');
            ratingText.textContent = '✓ ' + ratingLabels[rating];
            ratingText.classList.remove('text-warning');
            ratingText.classList.add('text-success', 'fw-bold');
        }
    </script>
</x-app-layout>
