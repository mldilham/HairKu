<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beri Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Info Booking -->
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">Detail Booking</h3>
                        <p><span class="font-medium">Barber:</span> {{ $barber->shop_name }}</p>
                        <p><span class="font-medium">Layanan:</span> {{ $booking->service->service_name }}</p>
                        <p><span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') }}</p>
                        <p><span class="font-medium">Jam:</span> {{ $booking->booking_time }}</p>
                    </div>

                    <form method="POST" action="{{ route('user.reviews.store') }}">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                        <!-- Rating with Hover Effects -->
                        <div class="mb-6">
                            <x-input-label for="rating" :value="__('Rating')" />
                            <div class="flex items-center gap-1 mt-3" id="star-container">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" required>
                                        <span class="star text-4xl text-gray-300 transition-all duration-150 select-none"
                                              data-rating="{{ $i }}"
                                              onmouseenter="highlightStars({{ $i }})"
                                              onmouseleave="resetStars()"
                                              onclick="selectStar({{ $i }})">
                                            ★
                                        </span>
                                        <!-- Tooltip -->
                                        <span class="absolute -bottom-8 left-1/2 -translate-x-1/2 text-xs font-medium text-white bg-gray-900 px-2 py-1 rounded opacity-0 peer-hover:opacity-100 transition-opacity whitespace-nowrap z-10">
                                            {{ $i }} {{ $i == 1 ? 'Buruk' : ($i == 2 ? 'Kurang' : ($i == 3 ? 'Cukup' : ($i == 4 ? 'Bagus' : 'Sangat Bagus'))) }}
                                        </span>
                                    </label>
                                @endfor
                            </div>
                            <!-- Rating Label -->
                            <div class="mt-3 h-6">
                                <span id="rating-text" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                    Klik bintang untuk rating
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>

                        <!-- Comment -->
                        <div class="mb-4">
                            <x-input-label for="comment" :value="__('Komentar (Opsional)')" />
                            <textarea name="comment" id="comment" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Tulis pengalaman Anda..."></textarea>
                            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('user.bookings.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Batal') }}
                            </a>

                            <x-primary-button>
                                {{ __('Simpan Review') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            const stars = document.querySelectorAll('.star');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400', 'scale-110');
                } else {
                    star.classList.remove('text-yellow-400', 'scale-110');
                    star.classList.add('text-gray-300');
                }
            });
            document.getElementById('rating-text').textContent = ratingLabels[rating];
            document.getElementById('rating-text').classList.add('text-yellow-600');
        }

        function resetStars() {
            const stars = document.querySelectorAll('.star');
            if (selectedRating > 0) {
                highlightStars(selectedRating);
                document.getElementById('rating-text').textContent = ratingLabels[selectedRating];
            } else {
                stars.forEach(star => {
                    star.classList.remove('text-yellow-400', 'scale-110');
                    star.classList.add('text-gray-300');
                });
                document.getElementById('rating-text').textContent = 'Klik bintang untuk rating';
            }
            document.getElementById('rating-text').classList.remove('text-yellow-600');
            document.getElementById('rating-text').classList.add('text-indigo-600');
        }

        function selectStar(rating) {
            selectedRating = rating;
            document.getElementById('rating-text').textContent = '✓ ' + ratingLabels[rating];
            document.getElementById('rating-text').classList.remove('text-yellow-600');
            document.getElementById('rating-text').classList.add('text-green-600');

            // Check the radio button
            document.querySelector(`input[name="rating"][value="${rating}"]`).checked = true;
        }
    </script>
</x-app-layout>
