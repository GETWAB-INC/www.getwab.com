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
        Log::info("🔔 /payment/result — Method: " . $request->method());
        Log::info('🔔 /payment/result — Payload:', $request->all());

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



}

