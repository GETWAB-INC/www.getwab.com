<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        Log::info('🔔 Silent POST от BoA', [
            'ip' => $request->ip(),
            'raw' => file_get_contents('php://input'),
            'parsed' => $data,
        ]);

        return response('OK');
    }

    public function paymentResult(Request $request)
    {
        $data = [
            'status' => $request->input('decision'), // ACCEPT, REJECT, etc.
            'message' => $request->input('message'), // "Request was processed successfully."

            'amount' => $request->input('auth_amount'), // 1.00
            'currency' => $request->input('req_currency'), // USD
            'card_type' => $request->input('card_type_name'), // Visa

            'name' => $request->input('req_bill_to_forename') . ' ' . $request->input('req_bill_to_surname'),
            'city' => $request->input('req_bill_to_address_city'),
            'state' => $request->input('req_bill_to_address_state'),
            'postal_code' => $request->input('req_bill_to_address_postal_code'),

            'transaction_id' => $request->input('transaction_id'),
            'order_number' => $request->input('req_reference_number'),
            'auth_code' => $request->input('auth_code'),
            'auth_time' => $request->input('auth_time'),
        ];

        return view('checkout.result', compact('data'));
    }


}

