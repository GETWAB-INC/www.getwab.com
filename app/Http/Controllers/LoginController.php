<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $throttleKey = 'login-attempt|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again in 5 minutes.'
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, true)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended('account');
        }

        RateLimiter::hit($throttleKey, 300);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function fpdsQuery(Request $request)
    {
        if (auth()->check()) {
            return redirect('https://fpds.getwab.com/query');
        }
    }

    public function showLinkRequestForm()
    {
        return view('password-request');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Password reset link sent! Check your email.')
            : back()->withErrors(['email' => 'Email not found or unable to send.']);
    }

    public function showResetForm($token)
    {
        return view('password-reset', compact('token'));
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
        ]);

        $status = Password::reset(
            $request->only('password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password successfully changed!')
            : back()->withErrors(['error' => 'Failed to reset password.']);
    }
}
