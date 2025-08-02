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

    $fields = [
        'access_key' => $accessKey,
        'profile_id' => $profileId,
        'transaction_uuid' => (string) \Str::uuid(),
        'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
        'locale' => 'en',
        'transaction_type' => 'sale',
        'reference_number' => 'ORDER-' . time(),
        'amount' => '1.00',
        'currency' => 'USD',
        'payment_method' => 'card',

        // Billing Info (фиксированный адрес)
        'bill_to_forename' => '',
        'bill_to_surname' => '',
        'bill_to_email' => '',
        'bill_to_address_line1' => '4532 Parnell Dr',
        'bill_to_address_city' => 'Sarasota',
        'bill_to_address_postal_code' => '34232',
        'bill_to_address_state' => 'FL',
        'bill_to_address_country' => 'US',

        // Card type — по умолчанию Visa
        'card_type' => '001',

        'unsigned_field_names' => 'card_number,card_expiry_date,card_cvn',
    ];

    $signedFields = [
        'access_key',
        'profile_id',
        'transaction_uuid',
        'signed_date_time',
        'locale',
        'transaction_type',
        'reference_number',
        'amount',
        'currency',
        'payment_method',
        'bill_to_forename',
        'bill_to_surname',
        'bill_to_email',
        'bill_to_address_line1',
        'bill_to_address_city',
        'bill_to_address_postal_code',
        'bill_to_address_state',
        'bill_to_address_country',
        'card_type',
        'signed_field_names',
        'unsigned_field_names',
    ];

    $fields['signed_field_names'] = implode(',', $signedFields);

    $dataToSign = collect($signedFields)
        ->map(fn($name) => "$name={$fields[$name]}")
        ->implode(',');

    $signature = base64_encode(hash_hmac('sha256', $dataToSign, $secretKey, true));

    return view('checkout.form', [
        'apiUrl' => $apiUrl,
        'fields' => $fields,
        'signature' => $signature,
    ]);
}


    public function handleCallback(Request $request)
    {
        $data = $request->all();

        // 1. Проверка подписи
        if (!$this->verifySignature($data)) {
            Log::warning('❌ Подпись не прошла проверку!', $data);
            return response('Invalid signature', 400);
        }

        // 2. Поиск и обновление заказа
        // $order = Order::where('reference_number', $data['req_reference_number'])->first();
        // if ($order) {
        //     $order->status = $data['decision'] === 'ACCEPT' ? 'paid' : 'declined';
        //     $order->transaction_id = $data['transaction_id'];
        //     $order->payment_response = json_encode($data);
        //     $order->save();
        // }

        // 3. Лог
        Log::info('✅ Silent POST обработан', [
            'ip' => $request->ip(),
            'reference' => $data['req_reference_number'],
            'decision' => $data['decision'],
        ]);

        return response('OK', 200);
    }

    public function paymentResult(Request $request)
    {
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

