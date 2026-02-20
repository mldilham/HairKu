<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Get or create barber profile for authenticated user.
     */
    private function getOrCreateBarber(): Barber
    {
        $barber = auth()->user()->barber;

        if (!$barber) {
            // Create barber profile if it doesn't exist
            $barber = Barber::create([
                'user_id' => auth()->id(),
                'shop_name' => auth()->user()->name . "'s Barbershop",
                'address' => 'Belum diatur',
            ]);
        }

        return $barber;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $barber = $this->getOrCreateBarber();

        $services = Service::where('barber_id', $barber->id)->get();

        return view('barber.services.index', compact('services', 'barber'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $barber = $this->getOrCreateBarber();

        return view('barber.services.create', compact('barber'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $barber = $this->getOrCreateBarber();

        Service::create([
            'barber_id' => $barber->id,
            'service_name' => $request->service_name,
            'price' => $request->price,
            'duration_minutes' => $request->duration_minutes,
        ]);

        return redirect()->route('barber.services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service): View
    {
        $barber = $this->getOrCreateBarber();

        // Ensure the service belongs to the authenticated barber
        if ($service->barber_id !== $barber->id) {
            abort(403);
        }

        return view('barber.services.edit', compact('service', 'barber'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $barber = $this->getOrCreateBarber();

        // Ensure the service belongs to the authenticated barber
        if ($service->barber_id !== $barber->id) {
            abort(403);
        }

        $service->update([
            'service_name' => $request->service_name,
            'price' => $request->price,
            'duration_minutes' => $request->duration_minutes,
        ]);

        return redirect()->route('barber.services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $barber = $this->getOrCreateBarber();

        // Ensure the service belongs to the authenticated barber
        if ($service->barber_id !== $barber->id) {
            abort(403);
        }

        $service->delete();

        return redirect()->route('barber.services.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
