<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\BillingService;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Удаляет элемент из сессии по ключу
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItem(Request $request)
    {
        // Получаем ключ элемента из запроса
        $itemKey = $request->input('item_key');

        // Проверяем, передан ли ключ
        if (empty($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Missing item key'
            ], 400);
        }

        // Проверяем, существует ли элемент в сессии
        if (!Session::has($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Item not found in session'
            ], 404);
        }

        // Удаляем элемент из сессии
        Session::forget($itemKey);

        // Возвращаем успешный ответ
        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function process(Request $request)
    {
        $hasItemsInCart = false;
        $cartItems = [
            'fpds_query_trial',
            'fpds_query_subscription',
            'fpds_report_subscription',
            'single_elementary_report',
            'single_composite_report',
            'elementary_report_package',
            'composite_report_package'
        ];

        foreach ($cartItems as $itemKey) {
            if (session()->has($itemKey)) {
                $hasItemsInCart = true;
                break;
            }
        }

        if (!$hasItemsInCart) {
            return back()
                ->withErrors(['cart' => 'No items in your cart. Please add products before proceeding.'])
                ->withInput();
        }

        if (Auth::check()) {
            // Пользователь авторизован: проверяем только обязательные поля без пароля
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'surname' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]*$/u',
                ],
                'city' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address1' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address2' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'zip' => [
                    'required',
                    'nullable',
                    'string',
                    'max:20',
                ],
            ], [
                'name.required' => 'First name is required.',
                'name.regex' => 'First name may only contain letters, spaces, and hyphens.',
                'surname.required' => 'Last name is required.',
                'surname.regex' => 'Last name may only contain letters, spaces, and hyphens.',
            ]);
        } else {
            // Пользователь не авторизован: полная валидация (включая email и пароль)
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[\pL\s\-]+$/u',
                ],
                'surname' => [
                    'required',
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
                'confirm_email' => [
                    'required',
                    'email',
                    'same:email',
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                ],
                'password_confirmation' => [
                    'required',
                ],
                'city' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address1' => [
                    'required',
                    'nullable',
                    'string',
                    'max:255',
                ],
                'address2' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'zip' => [
                    'required',
                    'nullable',
                    'string',
                    'max:20',
                ],
            ], [
                'name.required' => 'First name is required.',
                'name.regex' => 'First name may only contain letters, spaces, and hyphens.',
                'surname.required' => 'Last name is required.',
                'surname.regex' => 'Last name may only contain letters, spaces, and hyphens.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'A user with this email already exists.',
                'confirm_email.required' => 'Please confirm your email address.',
                'confirm_email.same' => 'The email confirmation does not match the email.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters long.',
                'password.confirmed' => 'The passwords do not match.',
                'password.regex' => 'Password must contain: uppercase letter, lowercase letter, number, and special character.',
                'password_confirmation.required' => 'Please confirm your password.',
            ]);
        }

        // dd(Auth::check(), $request->session()->all(), $request->all());

        $email = Auth::check() ? Auth::user()->email : $validated['email'];

        if (!Auth::check()) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                $registerController = new \App\Http\Controllers\RegisterController();
                $user = $registerController->registerThruOrder($validated);
            }
            Auth::login($user, true);
        }

        // Переключатель тестового режима
        $testMode = true; // Меняйте это значение для тестирования

        if (!$testMode) {
            // Здесь будет реальная интеграция с платёжным шлюзом
            $paymentSuccessful = false; // Заглушка
        } else {
            $paymentSuccessful = true;
        }

        if ($paymentSuccessful) {
            $billingService = new BillingService();

            // 1. Обрабатываем подписки
            $subscriptionResult = $billingService->processSubscriptions();

            // 2. Обрабатываем пакеты отчётов
            $packageResult = $billingService->processReportPackage();

            // 3. Собираем общий результат
            $success = $subscriptionResult['success'] && $packageResult['success'];
            $messages = array_merge($subscriptionResult['messages'], $packageResult['messages']);

            if ($success) {
                return view('thank-you')->with('messages', $messages);
            } else {
                return view('cancelled')->with('errors', $messages);
            }
        } else {
            return view('cancelled')->with('errors', ['Payment failed']);
        }
    }
}
