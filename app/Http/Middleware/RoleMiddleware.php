<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Cek apakah role user sesuai dengan yang diharapkan
        if ($request->user()->role !== $role) {
            // Redirect ke dashboard sesuai role user
            if ($request->user()->role === 'barber') {
                return redirect()->route('barber.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut!');
            }

            return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut!');
        }

        return $next($request);
    }
}
