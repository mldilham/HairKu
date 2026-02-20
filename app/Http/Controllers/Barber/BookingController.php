<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Booking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Get or create barber profile for authenticated user.
     */
    private function getOrCreateBarber(): Barber
    {
        $barber = auth()->user()->barber;

        if (!$barber) {
            $barber = Barber::create([
                'user_id' => auth()->id(),
                'shop_name' => auth()->user()->name . "'s Barbershop",
                'address' => 'Belum diatur',
            ]);
        }

        return $barber;
    }

    /**
     * Display a listing of bookings for the barber.
     */
    public function index(): View
    {
        $barber = $this->getOrCreateBarber();

        $bookings = Booking::where('barber_id', $barber->id)
            ->with(['user', 'service'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->get();

        return view('barber.bookings.index', compact('bookings', 'barber'));
    }

    /**
     * Accept a booking (change status to accepted).
     */
    public function accept(Booking $booking): RedirectResponse
    {
        $barber = $this->getOrCreateBarber();

        // Ensure the booking belongs to this barber
        if ($booking->barber_id !== $barber->id) {
            abort(403);
        }

        if ($booking->status === 'pending') {
            $booking->update(['status' => 'accepted']);
            return redirect()->route('barber.bookings.index')
                ->with('success', 'Booking berhasil diterima!');
        }

        return redirect()->route('barber.bookings.index')
            ->with('error', 'Booking tidak dapat diterima!');
    }

    /**
     * Reject a booking (change status to cancelled).
     */
    public function reject(Booking $booking): RedirectResponse
    {
        $barber = $this->getOrCreateBarber();

        // Ensure the booking belongs to this barber
        if ($booking->barber_id !== $barber->id) {
            abort(403);
        }

        if ($booking->status === 'pending' || $booking->status === 'accepted') {
            $booking->update(['status' => 'cancelled']);
            return redirect()->route('barber.bookings.index')
                ->with('success', 'Booking berhasil ditolak!');
        }

        return redirect()->route('barber.bookings.index')
            ->with('error', 'Booking tidak dapat ditolak!');
    }

    /**
     * Mark booking as on the way.
     */
    public function onTheWay(Booking $booking): RedirectResponse
    {
        $barber = $this->getOrCreateBarber();

        if ($booking->barber_id !== $barber->id) {
            abort(403);
        }

        if ($booking->status === 'accepted') {
            $booking->update(['status' => 'on_the_way']);
            return redirect()->route('barber.bookings.index')
                ->with('success', 'Status booking diubah menjadi Sedang Berangkat!');
        }

        return redirect()->route('barber.bookings.index')
            ->with('error', 'Status tidak dapat diubah!');
    }

    /**
     * Mark booking as completed.
     */
    public function complete(Booking $booking): RedirectResponse
    {
        $barber = $this->getOrCreateBarber();

        if ($booking->barber_id !== $barber->id) {
            abort(403);
        }

        if ($booking->status === 'accepted' || $booking->status === 'on_the_way') {
            $booking->update(['status' => 'completed']);
            return redirect()->route('barber.bookings.index')
                ->with('success', 'Booking berhasil diselesaikan!');
        }

        return redirect()->route('barber.bookings.index')
            ->with('error', 'Booking tidak dapat diselesaikan!');
    }
}
