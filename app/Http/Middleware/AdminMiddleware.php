<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            Log::info('User dengan ID ' . Auth::id() . ' mencoba mengakses: ' . $request->path());
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }

            // Redirect atau beri respon jika bukan admin
            return redirect()->route('ukkb')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        return redirect('/login');

    }
}
