<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FpdsAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return response('', 401);
        }

        return $next($request);
    }
}
