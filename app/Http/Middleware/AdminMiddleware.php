<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login dan email-nya adalah admin@gmail.com
        if (Auth::check() && Auth::user()->email === 'admin@gmail.com') {
            return $next($request);
        }
        
        // Jika bukan admin, redirect ke homepage dengan pesan error
        return redirect()->route('homepage')->with('error', 'Anda tidak memiliki akses ke halaman admin');
    }
}