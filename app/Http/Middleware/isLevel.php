<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels) 
    {
        if (in_array(auth()->user()->level, $levels)) {
            // Simpan halaman saat ini sebelum melanjutkan
            session(['last_accessed_page' => $request->fullUrl()]);
            return $next($request);
        }
        
        // Redirect ke halaman terakhir yang disimpan di session
        $lastPage = session('last_accessed_page', 'dashboard');
        
        return redirect($lastPage)->with('failed', 'Anda tidak memiliki hak akses untuk halaman ini!');
    }
}
