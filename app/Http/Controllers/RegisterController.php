<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

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

    /**
     * Регистрирует пользователя из данных заказа (с паролем из формы).
     *
     * @param array $orderData Данные из формы заказа (включая password и password_confirmation)
     * @return User
     */
    public function registerThruOrder(array $orderData): User
    {
        $email = $orderData['email'];

        // Проверяем, есть ли пользователь с таким email
        $user = User::where('email', $email)->first();

        if ($user) {
            return $user; // Уже существует — возвращаем
        }

        // Создаём пользователя с переданным паролем
        $user = User::create([
            'name' => $orderData['name'],
            'surname' => $orderData['surname'] ?? null,
            'email' => $email,
            'password' => Hash::make($orderData['password']),
        ]);

        // Отправляем письмо для верификации
        try {
            Mail::to($user->email)->send(new VerifyEmail($user));
        } catch (\Exception $e) {
            \Log::warning('Failed to send verification email', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
        }

        return $user;
    }

    /**
     * Обрабатывает верификацию email по ссылке.
     *
     * @param Request $request
     * @param int $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, int $user)
    {
        // Ищем пользователя по ID
        $user = User::find($user);

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'User not found.');
        }

        // Проверяем, не верифицирован ли уже
        if ($user->is_verified) {
            return redirect()->route('login')
                ->with('info', 'Email already verified.');
        }

        // Обновляем статус верификации
        $user->update(['is_verified' => true]);

        // Автоматически логиним пользователя
        Auth::login($user, true);

        return redirect()->route('account')
            ->with('success', 'Your email has been verified! You are now logged in.');
    }
}
