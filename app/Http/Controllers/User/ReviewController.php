<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Show the form to create a review for a completed booking.
     */
    public function create(Booking $booking): View
    {
        // Validasi: hanya bisa review jika status completed
        if ($booking->status !== 'completed') {
            abort(403, 'Anda hanya bisa memberikan review untuk booking yang sudah selesai.');
        }

        // Validasi: user yang sedang login harus pemilik booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke booking ini.');
        }

        // Validasi: belum ada review untuk booking ini
        $existingReview = Review::where('booking_id', $booking->id)->first();
        if ($existingReview) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Booking ini sudah pernah direview.');
        }

        $barber = Barber::findOrFail($booking->barber_id);

        return view('user.reviews.create', compact('booking', 'barber'));
    }

    /**
     * Store a newly created review.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Validasi: hanya bisa review jika status completed
        if ($booking->status !== 'completed') {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Anda hanya bisa memberikan review untuk booking yang sudah selesai.');
        }

        // Validasi: user yang sedang login harus pemilik booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke booking ini.');
        }

        // Validasi: belum ada review untuk booking ini
        $existingReview = Review::where('booking_id', $booking->id)->first();
        if ($existingReview) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'Booking ini sudah pernah direview.');
        }

        // Create review
        Review::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'barber_id' => $booking->barber_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Terima kasih! Review Anda telah disimpan.');
    }
}
