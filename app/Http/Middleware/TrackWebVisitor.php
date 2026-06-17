<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\WebVisitor;
use Symfony\Component\HttpFoundation\Response;

class TrackWebVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan perekaman hanya untuk request halaman (bukan file css/js/images atau request Ajax)
        if ($request->isMethod('GET') && !$request->ajax()) {
            WebVisitor::create([
                'ip_address' => $request->ip(),
                'session_id' => $request->session()->getId(), // Mengambil ID session unik milik user dari laravel
                'page_url'   => $request->fullUrl(),
            ]);
        }

        return $next($request);
    }
}
