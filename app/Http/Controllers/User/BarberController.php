<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use Illuminate\View\View;

class BarberController extends Controller
{
    /**
     * Display a listing of all barbers.
     */
    public function index(): View
    {
        $search = request('search');

        $query = Barber::with(['user', 'services', 'reviews'])
            ->whereHas('user', function ($q) {
                $q->where('role', 'barber');
            });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('shop_name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $barbers = $query->paginate(9);

        return view('barbers.index', compact('barbers', 'search'));
    }

    /**
     * Display the specified barber with their services.
     */
    public function show(int $id): View
    {
        $barber = Barber::with(['user', 'services', 'reviews.user'])
            ->findOrFail($id);

        return view('barbers.show', compact('barber'));
    }
}
