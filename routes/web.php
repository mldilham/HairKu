<?php

use App\Http\Controllers\Barber\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BarberController;
use App\Http\Controllers\User\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/barbers', [BarberController::class, 'index'])->name('barbers.index');
Route::get('/barbers/{id}', [BarberController::class, 'show'])->name('barbers.show');

Route::get('/user/dashboard', function () {
    return view('dashboard.user');
})->middleware(['auth', 'verified', 'role:user'])->name('user.dashboard');

Route::get('/barber/dashboard', function () {
    return view('dashboard.barber');
})->middleware(['auth', 'verified', 'role:barber'])->name('barber.dashboard');

// Barber Routes - Services CRUD (hanya bisa diakses barber)
Route::middleware(['auth', 'verified', 'role:barber'])->prefix('barber')->name('barber.')->group(function () {
    Route::resource('services', ServiceController::class);

    // Booking management
    Route::get('bookings', [App\Http\Controllers\Barber\BookingController::class, 'index'])->name('bookings.index');
    Route::patch('bookings/{booking}/accept', [App\Http\Controllers\Barber\BookingController::class, 'accept'])->name('bookings.accept');
    Route::patch('bookings/{booking}/reject', [App\Http\Controllers\Barber\BookingController::class, 'reject'])->name('bookings.reject');
    Route::patch('bookings/{booking}/onTheWay', [App\Http\Controllers\Barber\BookingController::class, 'onTheWay'])->name('bookings.onTheWay');
    Route::patch('bookings/{booking}/complete', [App\Http\Controllers\Barber\BookingController::class, 'complete'])->name('bookings.complete');
});

// User Routes - Booking (hanya bisa diakses user)
Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::resource('bookings', BookingController::class);
    Route::patch('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Review routes
    Route::get('reviews/create/{booking}', [App\Http\Controllers\User\ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reviews', [App\Http\Controllers\User\ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
