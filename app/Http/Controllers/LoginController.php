<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = 'login-attempt|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            // Use Laravel's abort function to throw a 403 Forbidden exception
            abort(403, 'Too many login attempts. Please try again in 5 minutes.');
        }

        if (Auth::attempt($credentials)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            // if ($request->input('next') === 'fpds') {
            //     $redirect = $request->input('redirect', '/query');
            //     return redirect()->to('/fpds/sso?redirect=' . urlencode($redirect));
            // }

            return redirect()->intended('dashboard');
        }

        RateLimiter::hit($throttleKey, 300); // 300 seconds = 5 minutes

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Gatekeeper for FPDS Query (Nginx auth_request)
     */
    public function fpdsQueryGate(Request $request)
    {
        // ❌ Не залогинен
        if (!Auth::check()) {
            return response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        // ❌ Залогинен, но нет доступа / подписки
        // if (!$user->hasFpdsAccess()) {
        //     return response('Forbidden', Response::HTTP_FORBIDDEN);
        // }

        // ✅ Всё ок
        return response('OK', Response::HTTP_OK);
    }
}

