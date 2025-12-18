<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Ключ для ограничения попыток (по IP)
        $throttleKey = 'login-attempt|' . $request->ip();

        // Проверка на превышение лимита попыток
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again in 5 minutes.'
            ])->onlyInput('email');
        }

        // Авторизация С ПРИНУДИТЕЛЬНОЙ ЗАПИСЬЮ В COOKIE (всегда "remember me")
        if (Auth::attempt($credentials, true)) { // Второй параметр = true
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended('account');
        }

        // Увеличиваем счётчик неудачных попыток
        RateLimiter::hit($throttleKey, 300); // блокировка на 5 минут

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
