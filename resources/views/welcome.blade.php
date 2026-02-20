<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="HairKu - Aplikasi Booking Potong Rambut">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HairKu') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=bebas-neue|figtree:300,400,500,600,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Banner Section -->
            <div class="relative bg-indigo-600 dark:bg-indigo-800">
                <div class="absolute inset-0">
                    <img class="w-full h-full object-cover opacity-20" src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80" alt="Barbershop">
                </div>
                <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                    <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                        HairKu
                    </h1>
                    <p class="mt-6 text-xl text-indigo-100 max-w-3xl">
                        Booking potong rambut mudah dan praktis. Temukan barber terbaik di sekitar Anda dan buat janji temu dengan mudah.
                    </p>
                    <div class="mt-10">
                        @auth
                            @if(Auth::user()->role === 'user')
                                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50">
                                    Dashboard Saya
                                </a>
                            @elseif(Auth::user()->role === 'barber')
                                <a href="{{ route('barber.dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50">
                                    Dashboard Barber
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50">
                                Daftar Sekarang
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white hover:text-indigo-100 ml-4">
                                Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="py-12 bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Cari Barber Terdekat</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Temukan barber terbaik di sekitar lokasi Anda dengan mudah.</p>
                        </div>
                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Booking Online</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Buat janji temu secara online kapan saja dan di mana saja.</p>
                        </div>
                        <div class="text-center">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Rating & Ulasan</h3>
                            <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Lihat rating dan ulasan dari pelanggan sebelumnya.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Rated Barbers Section -->
            @php
                $topBarbers = \App\Models\Barber::with(['user', 'reviews'])
                    ->whereHas('user', fn($q) => $q->where('role', 'barber'))
                    ->get()
                    ->sortByDesc(fn($b) => $b->getAverageRating())
                    ->take(3);
            @endphp

            @if($topBarbers->isNotEmpty())
                <div class="py-12 bg-gray-50 dark:bg-gray-900">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Barber Terpopuler</h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Berikut adalah barber dengan rating tertinggi</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($topBarbers as $barber)
                                <a href="{{ route('barbers.show', $barber->id) }}" class="block bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-6">
                                    <div class="flex items-center space-x-4">
                                        @if($barber->photo)
                                            <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->shop_name }}" class="w-16 h-16 rounded-full object-cover">
                                        @else
                                            <div class="w-16 h-16 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                <span class="text-2xl text-white">{{ substr($barber->shop_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $barber->shop_name }}</h3>
                                            <div class="flex items-center mt-1">
                                                <div class="flex">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= round($barber->getAverageRating()))
                                                            <span class="text-yellow-500 text-sm">★</span>
                                                        @else
                                                            <span class="text-gray-300 text-sm">★</span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">({{ $barber->getReviewCount() }})</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-8 text-center">
                            <a href="{{ route('barbers.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition">
                                Lihat Semua Barber →
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8">
                        <p class="text-center text-base text-gray-400">
                            &copy; {{ date('Y') }} HairKu. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
