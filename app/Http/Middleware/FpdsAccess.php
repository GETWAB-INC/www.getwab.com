<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FpdsAccess
{
    public function handle(Request $request, Closure $next)
    {
        // ВАЖНО: только статусы, никаких redirect()
        if (!Auth::check()) {
            return response('Unauthorized', 401);
        }

        $user = Auth::user(); // тут уже залогинен

        // TODO: проверка подписки (вставишь свою)
        // if (!$user->hasActiveSubscription()) {
        //     return response('Forbidden', 403);
        // }

        return response('', 204);
    }
}
