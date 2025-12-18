<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Добавляем фасад Auth

class RegisterController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s\-]+$/u',
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

            // Автоматически логиним пользователя
            Auth::login($user, true);

            // Перенаправляем на маршрут 'account'
            return redirect()->route('account')
                ->with('success', 'Registration successful! You are now logged in.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }
}
