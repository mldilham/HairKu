<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('user.bookings.store') }}">
                        @csrf

                        <!-- Barber Selection -->
                        <div class="mb-4">
                            <x-input-label for="barber_id" :value="__('Select Barber')" />
                            <select id="barber_id" name="barber_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>{{ __('Select a barber') }}</option>
                                @foreach($barbers as $barber)
                                    <option value="{{ $barber->id }}">{{ $barber->shop_name }} ({{ $barber->user->name }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('barber_id')" class="mt-2" />
                        </div>

                        <!-- Service Selection -->
                        <div class="mb-4">
                            <x-input-label for="service_id" :value="__('Select Service')" />
                            <select id="service_id" name="service_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="" disabled selected>{{ __('Select a service') }}</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" data-price="{{ $service->price }}" data-duration="{{ $service->duration_minutes }}">
                                        {{ $service->service_name }} - Rp {{ number_format($service->price, 0, ',', '.') }} ({{ $service->duration_minutes }} menit)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <!-- Booking Date -->
                        <div class="mb-4">
                            <x-input-label for="booking_date" :value="__('Booking Date')" />
                            <x-text-input id="booking_date" class="block mt-1 w-full" type="date" name="booking_date" :value="old('booking_date')" required min="{{ date('Y-m-d') }}" />
                            <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
                        </div>

                        <!-- Booking Time -->
                        <div class="mb-4">
                            <x-input-label for="booking_time" :value="__('Booking Time')" />
                            <x-text-input id="booking_time" class="block mt-1 w-full" type="time" name="booking_time" :value="old('booking_time')" required />
                            <x-input-error :messages="$errors->get('booking_time')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('user.bookings.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Book Now') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
