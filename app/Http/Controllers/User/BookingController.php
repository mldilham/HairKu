<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Constructor - Check if user is a barber (barber can't make bookings)
     */
    public function __construct()
    {
        // Prevent barber from accessing booking routes
        if (auth()->check() && auth()->user()->isBarber()) {
            abort(403, 'Barber cannot make bookings. Please use the barber dashboard.');
        }
    }

    /**
     * Display a listing of bookings for the user.
     */
    public function index(): View
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with(['barber', 'service'])
            ->orderBy('booking_date', 'desc')
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create(): View
    {
        $barbers = Barber::with('user')->get();
        $services = Service::with('barber')->get();

        return view('user.bookings.create', compact('barbers', 'services'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
        ]);

        $barber = Barber::findOrFail($request->barber_id);

        // Validasi: User tidak bisa booking dirinya sendiri
        if ($barber->user_id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak bisa booking jasa barber sendiri!')
                ->withInput();
        }

        // Validasi: Prevent double booking di jam yang sama
        $existingBooking = Booking::where('barber_id', $request->barber_id)
            ->where('booking_date', $request->booking_date)
            ->where('booking_time', $request->booking_time)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return redirect()->back()
                ->with('error', 'Maaf, jam tersebut sudah dibooking oleh customer lain. Silakan pilih jam lain.')
                ->withInput();
        }

        $service = Service::findOrFail($request->service_id);

        Booking::create([
            'user_id' => auth()->id(),
            'barber_id' => $request->barber_id,
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'status' => 'pending',
            'total_price' => $service->price,
        ]);

        return redirect()->route('user.bookings.index')
            ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Cancel the specified booking.
     */
    public function cancel(Booking $booking): RedirectResponse
    {
        // Ensure the booking belongs to the authenticated user
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status === 'pending' || $booking->status === 'confirmed') {
            $booking->update(['status' => 'cancelled']);
            return redirect()->route('user.bookings.index')
                ->with('success', 'Booking berhasil dibatalkan!');
        }

        return redirect()->route('user.bookings.index')
            ->with('error', 'Booking tidak dapat dibatalkan!');
    }

    /**
     * Display user dashboard with bookings.
     */
    public function dashboard(): View
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with(['barber', 'service'])
            ->get();

        return view('dashboard.user', compact('bookings'));
    }
}
