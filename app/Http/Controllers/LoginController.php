<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect('account');
        }
        return view('login');
    }
    /**
     * Handle user login attempt with basic rate limiting.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginProcess(Request $request)
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

    /**
     * Gatekeeper endpoint for FPDS Query (used by Nginx auth_request).
     *
     * Note: all access control logic is handled by the fpds.access middleware.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function fpdsQueryGate(Request $request)
    {
        return response('', 204);
    }

    /**
     * Redirect authenticated users to the FPDS Query application.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function fpdsQuery(Request $request)
    {
        if (auth()->check()) {
            return redirect('https://getwab.com/fpds/query');
        }

        return null;
    }

    /**
     * Show the password reset link request form.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLinkRequestForm()
    {
        return view('password-request');
    }

    /**
     * Send a password reset link to the given email address.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Show the password reset form for a given reset token.
     *
     * @param string $token
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showResetForm($token)
    {
        $email = request()->query('email');
        return view('password-reset', compact('token', 'email'));
    }

    /**
     * Reset the user's password using the provided token.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
            ],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password successfully changed!')
            : back()->withErrors(['email' => __($status)]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login');
    }
}
