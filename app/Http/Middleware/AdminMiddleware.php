<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role_id !== 3) {
            return redirect('/')->with('error', 'Nincs jogosultságod az admin oldalhoz.');
        }

        return $next($request);
    }
}
