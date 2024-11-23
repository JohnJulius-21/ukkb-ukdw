<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'mahasiswa') {
            return $next($request);
        }

        // Redirect atau beri respon jika bukan mahasiswa
        return redirect()->route('pendataan')->with('error', 'Anda tidak memiliki akses ke halaman ini.');

    }
}
