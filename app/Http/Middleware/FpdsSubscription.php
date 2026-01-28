<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class FpdsSubscription
{
    // какой тип подписки проверяем
    private const SUBSCRIPTION_TYPE = 'fpds_query';

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // если не залогинен
        if (!$user) {
            return response('Unauthorized', 401);
        }

        $hasSubscription = Subscription::where('user_id', $user->id)
            ->where('subscription_type', self::SUBSCRIPTION_TYPE)
            ->whereIn('status', ['active', 'trial'])
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->exists();

        if (!$hasSubscription) {
            return response('Subscription required', 403);
        }

        return $next($request);
    }
}
