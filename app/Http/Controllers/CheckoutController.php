<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\BillingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $accessKey = env('SECURE_ACCEPTANCE_ACCESS_KEY');
        $profileId = env('SECURE_ACCEPTANCE_PROFILE_ID');
        $secretKey = env('SECURE_ACCEPTANCE_SECRET_KEY');
        $apiUrl = env('SECURE_ACCEPTANCE_API_URL');

        return view('checkout.form', [
            'access_key' => $accessKey,
            'profile_id' => $profileId,
            'secret_key' => $secretKey,
            'apiUrl' => $apiUrl,
        ]);
    }

    public function handleCallback(Request $request)
    {
        $data = $request->all();

        // Log silent POST callback from Bank of America
        Log::channel('checkout')->info('🔔 /checkout/callback — Silent POST from BoA', [
            'ip' => $request->ip(),
            'raw' => file_get_contents('php://input'),
            'parsed' => $data,
        ]);

        return response('OK');
    }

    public function paymentResult(Request $request)
    {
        // Log payment result endpoint call
        Log::channel('checkout')->info("🔔 /payment/result — Method: " . $request->method());
        Log::channel('checkout')->info('🔔 /payment/result — Payload:', $request->all());

        $data = [
            'status' => $request->get('decision'),
            'amount' => $request->get('auth_amount'),
            'currency' => $request->get('req_currency'),
            'card_type' => $request->get('card_type_name'),
            'name' => trim($request->get('req_bill_to_forename') . ' ' . $request->get('req_bill_to_surname')),
            'city' => $request->get('req_bill_to_address_city'),
            'state' => $request->get('req_bill_to_address_state'),
            'zip' => $request->get('req_bill_to_address_postal_code'),
            'transaction_id' => $request->get('transaction_id'),
            'order_number' => $request->get('req_reference_number'),
            'auth_code' => $request->get('auth_code'),
            'auth_time' => $request->get('auth_time'),
        ];

        return view('checkout.result', compact('data'));
    }

    public function checkout(Request $request)
    {
        $accessKey = env('SECURE_ACCEPTANCE_ACCESS_KEY');
        $profileId = env('SECURE_ACCEPTANCE_PROFILE_ID');
        $secretKey = env('SECURE_ACCEPTANCE_SECRET_KEY');
        $apiUrl = env('SECURE_ACCEPTANCE_API_URL');

        return view('checkout', [
            'access_key' => $accessKey,
            'profile_id' => $profileId,
            'secret_key' => $secretKey,
            'apiUrl' => $apiUrl,
        ]);
    }

    /**
     * Remove an item from the session by its key
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeItem(Request $request)
    {
        // Get item key from request
        $itemKey = $request->input('item_key');

        // Validate that item key is provided
        if (empty($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Missing item key'
            ], 400);
        }

        // Check if the item exists in the session
        if (!Session::has($itemKey)) {
            return response()->json([
                'success' => false,
                'error' => 'Item not found in session'
            ], 404);
        }

        // Remove item from session
        Session::forget($itemKey);

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function process(Request $request)
    {
        $hasItemsInCart = false;

        // List of supported cart item session keys
        $cartItems = [
            'fpds_query_trial',
            'fpds_query_subscription',
            'fpds_report_subscription',
            'single_elementary_report',
            'single_composite_report',
            'elementary_report_package',
            'composite_report_package'
        ];

        // Check if at least one item exists in the cart
        foreach ($cartItems as $itemKey) {
            if (session()->has($itemKey)) {
                $hasItemsInCart = true;
                break;
            }
        }

        // Stop checkout if cart is empty
        if (!$hasItemsInCart) {
            return back()
                ->withErrors(['cart' => 'No items in your cart. Please add products before proceeding.'])
                ->withInput();
        }

        if (Auth::check()) {
            // Authenticated user: validate required billing fields only (no password/email)
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
            // Guest user: full validation including email and password
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

        // Determine user email
        $email = Auth::check() ? Auth::user()->email : $validated['email'];

        if (!Auth::check()) {
            // Create or fetch user and log them in
            $user = User::where('email', $email)->first();

            if (!$user) {
                $registerController = new \App\Http\Controllers\RegisterController();
                $user = $registerController->registerThruOrder($validated);
            }

            Auth::login($user, true);
        }

        // Test mode switch (disable for real payment processing)
        $testMode = true;

        if (!$testMode) {
            // Real payment gateway integration will be implemented here
            $paymentSuccessful = false; // Placeholder
        } else {
            $paymentSuccessful = true;
        }

        if ($paymentSuccessful) {
            $billingService = new BillingService();

            // 1. Process subscriptions
            $subscriptionResult = $billingService->processSubscriptions();

            // 2. Process report packages
            $packageResult = $billingService->processReportPackage();

            // 3. Combine results
            $success = $subscriptionResult['success'] && $packageResult['success'];
            $messages = array_merge($subscriptionResult['messages'], $packageResult['messages']);

            if ($success) {
                return view('thank-you')->with('messages', $messages);
            } else {
                return view('cancelled')->with('errors', $messages);
            }
        }

        return view('cancelled')->with('errors', ['Payment failed']);
    }
}
