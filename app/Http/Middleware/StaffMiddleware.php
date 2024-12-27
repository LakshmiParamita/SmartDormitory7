<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->usertype === 'staff') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Akses tidak diizinkan');
    }
} 