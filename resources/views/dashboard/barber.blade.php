<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Barber Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Welcome, ') . Auth::user()->name . '!' }}</h3>
                    <p class="mb-4">{{ __('You are logged in as Barber.') }}</p>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-2">{{ __('Manage Services') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ __('Kelola layanan barber Anda (tambah, edit, hapus layanan).') }}</p>
                        <a href="{{ route('barber.services.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Kelola Layanan') }}
                        </a>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-2">{{ __('Manage Orders') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ __('Anda dapat melihat dan menerima order booking dari customer.') }}</p>
                        <a href="{{ route('barber.bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Lihat Booking Masuk') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
