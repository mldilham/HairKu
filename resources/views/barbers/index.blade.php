<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Barber') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Pilih Barber') }}</h3>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('barbers.index') }}" class="mb-6">
                        <div class="flex gap-2">
                            <input
                                type="text"
                                name="search"
                                value="{{ $search ?? '' }}"
                                placeholder="Cari barber..."
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Cari
                            </button>
                            @if($search)
                                <a href="{{ route('barbers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>

                    @if ($barbers->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">Belum ada barber yang tersedia.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($barbers as $barber)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-lg transition-shadow">
                                    <div class="flex items-center space-x-4">
                                        @if ($barber->photo)
                                            <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->shop_name }}" class="w-16 h-16 rounded-full object-cover">
                                        @else
                                            <div class="w-16 h-16 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                <span class="text-2xl text-white">{{ substr($barber->shop_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="text-lg font-semibold">{{ $barber->shop_name }}</h4>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $barber->user->name }}</p>
                                        </div>
                                    </div>

                                    @if ($barber->address)
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Alamat:</span> {{ $barber->address }}
                                        </p>
                                    @endif

                                    <div class="flex items-center justify-between mt-2">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            <span class="font-medium">Layanan:</span> {{ $barber->services->count() }} tersedia
                                        </p>
                                        <div class="flex items-center">
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= round($barber->getAverageRating()))
                                                        <span class="text-yellow-500 text-sm">★</span>
                                                    @else
                                                        <span class="text-gray-300 text-sm">★</span>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">
                                                ({{ $barber->getReviewCount() }})
                                            </span>
                                        </div>
                                    </div>

                                    <a href="{{ route('barbers.show', $barber->id) }}" class="mt-4 inline-block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition">
                                        Lihat Detail & Layanan
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $barbers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
