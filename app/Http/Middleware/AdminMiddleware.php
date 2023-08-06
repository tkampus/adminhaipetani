<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Cek apakah pengguna memiliki role 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request);
            }
        }

        // Jika tidak memiliki role 'admin', arahkan ke halaman beranda atau halaman lain yang sesuai
        return redirect('logout');
    }
}
