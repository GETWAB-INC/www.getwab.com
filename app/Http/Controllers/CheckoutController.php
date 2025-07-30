<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $access_key = 'abd7db4aaf5a318ebbc44297b3528a0c';
        $profile_id = '069E822B-906F-43F1-B7D1-57DE588E9AEF';
        $secret_key = 'a10e614ffbc24c49a26f761f331e856d796f7a33d1814829b67a144b2b0858972882a25998ae4d5886061fa692e64dffec8d356da72f4372915322e7c9ca63cd7d0c55b8455e40c19bd345bee8d515367d0206524eae4beea274ec96ce477f373dcf82515cbf417daf8697523e593b7763e2a38c6fff4b2ba210c3412e3774d9';

        $fields = [
            'access_key' => $access_key,
            'profile_id' => $profile_id,
            'transaction_uuid' => uniqid(),
            'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
            'locale' => 'en',
            'transaction_type' => 'sale',
            'reference_number' => 'ORDER-' . rand(1000, 9999),
            'amount' => '1.09',
            'currency' => 'USD',
            'payment_method' => 'card',
        ];

        $fields['signed_field_names'] = implode(',', array_keys($fields));

        // Подпись
        $message = implode(',', array_map(function ($k, $v) {
            return "$k=$v";
        }, array_keys($fields), array_values($fields)));

        $fields['signature'] = base64_encode(hash_hmac('sha256', $message, $secret_key, true));

        return view('checkout.form', compact('fields'));
    }


    public function handleCallback(Request $request)
    {
        Log::info('🔁 Payment callback from FIS', $request->all());

        if ($request->input('decision') === 'ACCEPT') {
            // TODO: обновить статус заказа в базе
        }

        return response('OK', 200);
    }

    public function showResult()
    {
        return view('checkout.result');
    }




}
