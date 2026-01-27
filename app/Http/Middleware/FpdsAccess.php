<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FpdsAccess
{
    // 🔴 ПЕРЕКЛЮЧАТЕЛЬ ПОДПИСКИ
    // true  = доступ есть
    // false = подписки нет → 403
    private const SUBSCRIPTION_ENABLED = false;

    public function handle(Request $request, Closure $next)
    {
        // 1) НЕ залогинен → 401
        if (!auth()->check()) {
            return response('', 401);
        }

        // 2) подписка выключена → 403
        if (!self::SUBSCRIPTION_ENABLED) {
            return response('', 403);
        }

        // 3) всё ок → 204
        return response('', 204);
    }
}
