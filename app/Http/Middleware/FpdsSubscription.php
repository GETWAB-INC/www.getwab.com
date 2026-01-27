<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FpdsSubscription
{
    // 🔘 переключатель подписки
    private const SUBSCRIPTION_ENABLED = true;

    public function handle(Request $request, Closure $next)
    {
        if (!self::SUBSCRIPTION_ENABLED) {
            return response('', 403);
        }

        return $next($request);
    }
}
