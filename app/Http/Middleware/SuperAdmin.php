<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
