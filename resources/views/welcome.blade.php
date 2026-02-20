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
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <!-- Header / Navigation -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="/" class="flex items-center space-x-2">
                            <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">HairKu</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#services" class="text-gray-600 hover:text-orange-500 font-medium transition">Layanan</a>
                        <a href="#barbers" class="text-gray-600 hover:text-orange-500 font-medium transition">Barber</a>
                        <a href="#reviews" class="text-gray-600 hover:text-orange-500 font-medium transition">Ulasan</a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-4">
                        @auth
                            @if(Auth::user()->role === 'user')
                                <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-orange-500 font-medium transition">Dashboard</a>
                            @elseif(Auth::user()->role === 'barber')
                                <a href="{{ route('barber.dashboard') }}" class="text-gray-600 hover:text-orange-500 font-medium transition">Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-orange-500 font-medium transition">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-orange-500 font-medium transition">Login</a>
                            <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-lg transition shadow-lg shadow-orange-500/30">
                                Daftar Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <!-- Badge -->
                            <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-orange-50 text-orange-600 text-sm font-semibold mb-6">
                                <span class="w-2 h-2 bg-orange-500 rounded-full mr-2 animate-pulse"></span>
                                Booking Mudah & Praktis
                            </div>

                            <!-- Headline -->
                            <h1 class="text-4xl tracking-tight font-bold text-gray-900 sm:text-5xl md:text-6xl">
                                <span class="block xl:inline">Tampilan Baru,</span>
                                <span class="block text-orange-500">Percaya Diri Baru</span>
                            </h1>

                            <!-- Subheadline -->
                            <p class="mt-4 text-base text-gray-500 sm:text-lg md:mt-6 md:text-xl max-w-2xl mx-auto lg:mx-0">
                                Dapatkan potongan rambut sempurna dari barber terbaik. Booking online mudah, praktis, dan tanpa antre. Waktunya tampil lebih baik!
                            </p>

                            <!-- CTA Buttons -->
                            <div class="mt-8 sm:flex sm:justify-center lg:justify-start space-x-4">
                                <div class="rounded-md shadow">
                                    <a href="{{ route('barbers.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-white bg-orange-500 hover:bg-orange-600 md:py-4 md:text-lg md:px-10 transition shadow-lg shadow-orange-500/30">
                                        Book Now
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="mt-3 sm:mt-0">
                                    <a href="#barbers" class="w-full flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-semibold rounded-lg text-gray-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition">
                                        Lihat Barber
                                    </a>
                                </div>
                            </div>

                            <!-- Stats -->
                            <div class="mt-10 pt-6 border-t border-gray-100">
                                <div class="flex flex-col sm:flex-row sm:space-x-8 space-y-4 sm:space-y-0">
                                    <div class="text-center sm:text-left">
                                        <p class="text-3xl font-bold text-gray-900">500+</p>
                                        <p class="text-sm text-gray-500">Barber Professional</p>
                                    </div>
                                    <div class="text-center sm:text-left">
                                        <p class="text-3xl font-bold text-gray-900">10.000+</p>
                                        <p class="text-sm text-gray-500">Pelanggan Puas</p>
                                    </div>
                                    <div class="text-center sm:text-left">
                                        <p class="text-3xl font-bold text-gray-900">4.9</p>
                                        <p class="text-sm text-gray-500">Rating Rata-rata</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1585747860715-2ba37e788b70?ixlib=rb-4.0.3&auto=format&fit=crop&w=2074&q=80" alt="Barbershop">
                <div class="absolute inset-0 bg-gradient-to-r from-white/90 to-transparent lg:from-white/30"></div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                        Layanan <span class="text-orange-500">Kami</span>
                    </h2>
                    <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                        Berbagai layanan potong rambut dan perawatan untuk pria agar selalu tampil optimal
                    </p>
                </div>

                <!-- Services Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Service Card 1 -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100 hover:border-orange-200">
                        <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-orange-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Haircut</h3>
                        <p class="text-gray-500 text-sm">Potong rambut dengan berbagai model sesuai tren terkini</p>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-orange-500 font-bold">Mulai dari Rp 30.000</span>
                        </div>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100 hover:border-orange-200">
                        <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-orange-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Hair Coloring</h3>
                        <p class="text-gray-500 text-sm">Warna rambut sesuai keinginan dengan produk berkualitas</p>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-orange-500 font-bold">Mulai dari Rp 100.000</span>
                        </div>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100 hover:border-orange-200">
                        <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-orange-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Beard Trim</h3>
                        <p class="text-gray-500 text-sm">Rapikan jenggot dan kumis dengan desain menarik</p>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-orange-500 font-bold">Mulai dari Rp 25.000</span>
                        </div>
                    </div>

                    <!-- Service Card 4 -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 group border border-gray-100 hover:border-orange-200">
                        <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-orange-500 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Styling</h3>
                        <p class="text-gray-500 text-sm">Styling rambut untuk acara khusus atau harian</p>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <span class="text-orange-500 font-bold">Mulai dari Rp 35.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Barbers Section -->
        @php
            $topBarbers = \App\Models\Barber::with(['user', 'reviews', 'services'])
                ->whereHas('user', fn($q) => $q->where('role', 'barber'))
                ->get()
                ->sortByDesc(fn($b) => $b->getAverageRating())
                ->take(4);
        @endphp

        @if($topBarbers->isNotEmpty())
            <section id="barbers" class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                            Barber <span class="text-orange-500">Terbaik</span>
                        </h2>
                        <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                            Temukan barber profesional dengan rating tertinggi di sekitar Anda
                        </p>
                    </div>

                    <!-- Barbers Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($topBarbers as $barber)
                            <a href="{{ route('barbers.show', $barber->id) }}" class="group">
                                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
                                    <!-- Barber Photo -->
                                    <div class="relative h-56 overflow-hidden">
                                        @if($barber->photo)
                                            <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->shop_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-orange-400 to-orange-600 flex items-center justify-center">
                                                <span class="text-5xl text-white font-bold">{{ substr($barber->shop_name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07c.3. 3.292921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span class="ml-1 text-sm font-semibold text-gray-800">{{ number_format($barber->getAverageRating(), 1) }}</span>
                                        </div>
                                    </div>

                                    <!-- Barber Info -->
                                    <div class="p-5">
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-orange-500 transition-colors">{{ $barber->shop_name }}</h3>
                                        <p class="text-gray-500 text-sm mt-1">{{ $barber->user->name }}</p>

                                        @if($barber->address)
                                            <p class="text-gray-400 text-xs mt-2 truncate">{{ $barber->address }}</p>
                                        @endif

                                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                                </svg>
                                                {{ $barber->getReviewCount() }} review
                                            </div>
                                            @if($barber->services->isNotEmpty())
                                                <span class="text-orange-500 font-semibold text-sm">
                                                    Rp {{ number_format($barber->services->min('price'), 0, ',', '.') }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="mt-4">
                                            <span class="block w-full text-center bg-orange-50 text-orange-600 font-semibold py-2 rounded-lg group-hover:bg-orange-500 group-hover:text-white transition-colors">
                                                Lihat Detail
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- View All Button -->
                    <div class="text-center mt-12">
                        <a href="{{ route('barbers.index') }}" class="inline-flex items-center px-6 py-3 border-2 border-orange-500 text-orange-500 font-semibold rounded-lg hover:bg-orange-500 hover:text-white transition">
                            Lihat Semua Barber
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- Reviews Section -->
        @php
            $recentReviews = \App\Models\Review::with(['user', 'barber'])
                ->latest()
                ->take(6)
                ->get();
        @endphp

        @if($recentReviews->isNotEmpty())
            <section id="reviews" class="py-20 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Section Header -->
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                            Ulasan <span class="text-orange-500">Pelanggan</span>
                        </h2>
                        <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
                            Apa kata pelanggan tentang pengalaman mereka di HairKu
                        </p>
                    </div>

                    <!-- Reviews Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recentReviews as $review)
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                                <!-- Review Header -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                            <span class="text-orange-600 font-semibold">{{ substr($review->user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $review->barber->shop_name }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
                                </div>

                                <!-- Rating -->
                                <div class="flex items-center mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>

                                <!-- Comment -->
                                @if($review->comment)
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- CTA Section -->
        <section class="py-20 bg-orange-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Siap Tampilan Baru?
                </h2>
                <p class="mt-4 text-xl text-orange-100 max-w-2xl mx-auto">
                    Booking sekarang dan rasakan pengalaman potong rambut yang berbeda
                </p>
                <div class="mt-8">
                    <a href="{{ route('barbers.index') }}" class="inline-flex items-center px-8 py-4 bg-white text-orange-500 font-bold rounded-lg hover:bg-gray-100 transition shadow-xl">
                        Book Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Brand -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                </svg>
                            </div>
                            <span class="text-xl font-bold">HairKu</span>
                        </div>
                        <p class="text-gray-400 max-w-sm">
                            Aplikasi booking potong rambut terbaik di Indonesia. Temukan barber profesional dan booking dengan mudah.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('barbers.index') }}" class="text-gray-400 hover:text-orange-400 transition">Cari Barber</a></li>
                            <li><a href="#services" class="text-gray-400 hover:text-orange-400 transition">Layanan</a></li>
                            <li><a href="#reviews" class="text-gray-400 hover:text-orange-400 transition">Ulasan</a></li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h4 class="font-semibold text-lg mb-4">Kontak</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li>info@hairku.id</li>
                            <li>+62 812 3456 7890</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 pt-8 border-t border-gray-800 text-center">
                    <p class="text-gray-400">
                        &copy; {{ date('Y') }} HairKu. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>
