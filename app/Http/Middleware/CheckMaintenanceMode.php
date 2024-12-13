<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_ON_MAINTENANCE', false)) {
            // Dapatkan daftar IP yang diizinkan
            $allowedIps = explode(',', env('ALLOWED_IPS', ''));
            // dd($request->ip());
            // Cek apakah IP pengguna ada di daftar IP yang diizinkan
            if (!in_array($request->ip(), $allowedIps)) {
                return response()->view('maintenance', [], 503); // Tampilkan halaman maintenance
            }
        }

        return $next($request);
    }
}
