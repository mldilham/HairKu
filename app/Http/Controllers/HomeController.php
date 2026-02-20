<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $topBarbers = Barber::with(['user', 'reviews', 'services'])
            ->whereHas('user', fn($q) => $q->where('role', 'barber'))
            ->get()
            ->sortByDesc(fn($b) => $b->getAverageRating())
            ->take(4);

        $services = Service::all()->groupBy('name');

        $recentReviews = Review::with(['user', 'barber'])
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('topBarbers', 'recentReviews'));
    }
}
