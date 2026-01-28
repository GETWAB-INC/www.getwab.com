<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;

class FpdsSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return response('Unauthorized', 401);
        }

        $hasSubscription = Subscription::where('user_id', $user->id)
            ->where('subscription_type', 'fpds_query')
            ->whereIn('status', ['active', 'trial'])
            ->exists();


        if (!$hasSubscription) {
            return response('Subscription required', 403);
        }

        return $next($request);
    }
}
