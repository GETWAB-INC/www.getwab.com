<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        if (auth()->check()) {
            return redirect()->route('account');
        }
        
        return view('register');

    }
    public function registerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [

        // Register Open
            // 'name' => [
            //     'required',
            //     'string',
            //     'max:255',
            //     'regex:/^[\pL\s\-]+$/u',
            // ],
        // Register Closed
            'name' => [
                'required',
                'string',
                'max:255',
                'in:admin',
            ],

            'surname' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\pL\s\-]*$/u',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ], [
            // Custom error messages
            'name.in' => 
            'FPDS Query is currently in private launch mode. ' .
            'Public registration is temporarily closed. ' .
            'Please use the contact form if you would like to get in touch.',

            'name.required' => 'First name is required.',
            'name.regex' => 'First name may only contain letters, spaces, and hyphens.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'A user with this email already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'The passwords do not match.',
            'password.regex' => 'Password must contain: uppercase letter, lowercase letter, number, and special character.',
        ]);

        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }

        // Create new user
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname ?? null,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user, true);

            // ===== EMAIL VERIFICATION (same as working controller) =====
            $secretKey = env('SECRET_KEY_FOR_EMAIL_VERIFICATION');
            $plainToken = $user->id . "|" . $request->email;
            $token = hash_hmac('sha256', $plainToken, $secretKey);

            try {
                Mail::to($user->email)->send(new VerifyEmail($user, $token));
            } catch (\Exception $e) {
                Log::warning('Failed to send verification email', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
            }

            return redirect()->route('account')
                ->with('success', 'Registration successful! You are now logged in.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }

    /**
     * Registers a user from the order data (with the password from the form).
     *
     * @param array $orderData Data from the order form (including password and password_confirmation)
     * @return User
     */
    public function registerThruOrder(array $orderData): User
    {
        $email = $orderData['email'];

        $user = User::where('email', $email)->first();

        if ($user) {
            return $user;
        }

        $user = User::create([
            'name' => $orderData['name'],
            'surname' => $orderData['surname'] ?? null,
            'email' => $email,
            'password' => Hash::make($orderData['password']),
        ]);

        // ===== EMAIL VERIFICATION (same as working controller) =====
        $secretKey = env('SECRET_KEY_FOR_EMAIL_VERIFICATION');
        $plainToken = $user->id . "|" . $email;
        $token = hash_hmac('sha256', $plainToken, $secretKey);

        try {
            Mail::to($user->email)->send(new VerifyEmail($user, $token));
        } catch (\Exception $e) {
            Log::warning('Failed to send verification email', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
        }

        return $user;
    }

    /**
     * Processes email verification via a link.
     *
     * @param Request $request
     * @param int $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, int $user)
    {
        // Find user by ID from the route parameter
        $user = User::find($user);

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'User not found.');
        }

        // 1) Get verification token from query string (?token=...)
        $token = (string) $request->query('token', '');

        if ($token === '') {
            return redirect()->route('login')
                ->with('error', 'Invalid verification link.');
        }

        // 2) Recalculate expected token (must match the one used during email sending)
        $secretKey = env('SECRET_KEY_FOR_EMAIL_VERIFICATION');
        $plainToken = $user->id . "|" . $user->email;
        $expected = hash_hmac('sha256', $plainToken, $secretKey);

        // 3) Securely compare tokens to prevent timing attacks
        if (!hash_equals($expected, $token)) {
            return redirect()->route('login')
                ->with('error', 'Invalid verification token.');
        }

        // 4) Mark email as verified (if not already verified)
        if (!$user->email_verified_at) {
            $user->update(['email_verified_at' => now()]);
        }

        // Log the user in after successful verification
        Auth::login($user, true);

        return redirect()->route('account')
            ->with('success', 'Your email has been verified! You are now logged in.');
    }


    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:100',
            'message' => 'required|string',
        ]);

        $contactMessage = ContactMessage::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}