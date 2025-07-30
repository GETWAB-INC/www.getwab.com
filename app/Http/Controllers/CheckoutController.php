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
        return view('checkout.form');
    }

    public function processPayment(Request $request)
    {
        // Валидация данных
        $request->validate([
            'card_number' => 'required|digits_between:13,19',
            'exp_month' => 'required|digits:2',
            'exp_year' => 'required|digits:4',
            'cvv' => 'required|digits_between:3,4',
            'cardholder_name' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $expMonth = str_pad($request->input('exp_month'), 2, '0', STR_PAD_LEFT);
        $expYearShort = substr($request->input('exp_year'), 2, 2); // последние 2 цифры года
        $expDate = $expMonth . '-' . $expYearShort; // формат MM-YY, например 08-27

        $names = explode(' ', $request->input('cardholder_name'));
        $firstName = $names[0] ?? 'John';
        $lastName = $names[1] ?? 'Doe';

        // Поля, которые надо подписать (в этом порядке!)
        $fieldsToSign = [
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
            'card_type',
            'card_number',
            'card_expiry_date',
            'card_cvn',
            'bill_to_forename',
            'bill_to_surname',
            'bill_to_email',
            'bill_to_address_line1',
            'bill_to_address_city',
            'bill_to_address_postal_code',
            'bill_to_address_state',
            'bill_to_address_country',
            'signed_field_names',
            'unsigned_field_names',
        ];

        $payload = [
            'access_key' => env('SECURE_ACCEPTANCE_ACCESS_KEY'),
            'profile_id' => env('SECURE_ACCEPTANCE_PROFILE_ID'),
            'transaction_uuid' => (string) Str::uuid(),
            'signed_date_time' => gmdate("Y-m-d\TH:i:s\Z"),
            'locale' => 'en',
            'transaction_type' => 'sale',
            'reference_number' => 'ORDER-' . uniqid(),
            'amount' => number_format($request->input('amount') / 100, 2, '.', ''),
            'currency' => 'USD',
            'payment_method' => 'card',
            'card_type' => '001', // Visa
            'card_number' => preg_replace('/\D/', '', $request->input('card_number')),
            'card_expiry_date' => $expDate,
            'card_cvn' => $request->input('cvv'),
            'bill_to_forename' => $firstName,
            'bill_to_surname' => $lastName,
            'bill_to_email' => 'test@example.com',
            'bill_to_address_line1' => '1 Market St',
            'bill_to_address_city' => 'San Francisco',
            'bill_to_address_postal_code' => '94105',
            'bill_to_address_state' => 'CA',
            'bill_to_address_country' => 'US',
            'unsigned_field_names' => '',
        ];

        // Включаем список подписываемых полей
        $payload['signed_field_names'] = implode(',', $fieldsToSign);

        // Формируем строку для подписи
        $dataToSign = [];
        foreach ($fieldsToSign as $field) {
            $dataToSign[] = $field . '=' . $payload[$field];
        }
        $dataToSignString = implode(',', $dataToSign);

        // Вычисляем HMAC SHA256 и кодируем в base64
        $signature = base64_encode(hash_hmac('sha256', $dataToSignString, env('SECURE_ACCEPTANCE_SECRET_KEY'), true));
        $payload['signature'] = $signature;

        // Отправляем запрос как form-urlencoded
        $response = Http::asForm()->post(env('SECURE_ACCEPTANCE_API_URL'), $payload);

        // Логируем для отладки
        Log::info('Payment Request Payload', $payload);
        Log::info('Payment Response', [
            'status' => $response->status(),
            'headers' => $response->headers(),
            'body' => $response->body(),
        ]);

        // Возвращаем ответ для проверки
        return response()->json([
            'status' => $response->status(),
            'body' => $response->json(),
        ]);
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

    public function test()
    {
        $uuid = (string) \Illuminate\Support\Str::uuid();
        $now = gmdate("Y-m-d\TH:i:s\Z");

        $payload = [
            'access_key' => env('SECURE_ACCEPTANCE_ACCESS_KEY'),
            'profile_id' => env('SECURE_ACCEPTANCE_PROFILE_ID'),
            'transaction_uuid' => $uuid,
            'signed_date_time' => $now,
            'locale' => 'en',
            'transaction_type' => 'sale',
            'reference_number' => 'TEST-' . uniqid(),
            'amount' => '5.00',
            'currency' => 'USD',
            'payment_method' => 'card',
            'card_type' => '001',
            'card_number' => '4111111111111111',
            'card_expiry_date' => '12-2025',
            'card_cvn' => '123',
            'bill_to_forename' => 'John',
            'bill_to_surname' => 'Doe',
            'bill_to_email' => 'john.doe@example.com',
            'bill_to_address_line1' => '1 Market St',
            'bill_to_address_city' => 'San Francisco',
            'bill_to_address_postal_code' => '94105',
            'bill_to_address_state' => 'CA',
            'bill_to_address_country' => 'US',
            'unsigned_field_names' => '',
        ];

        $fieldsToSign = [
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
            'card_type',
            'card_number',
            'card_expiry_date',
            'card_cvn',
            'bill_to_forename',
            'bill_to_surname',
            'bill_to_email',
            'bill_to_address_line1',
            'bill_to_address_city',
            'bill_to_address_postal_code',
            'bill_to_address_state',
            'bill_to_address_country',
            'signed_field_names',
            'unsigned_field_names',
        ];

        $payload['signed_field_names'] = implode(',', $fieldsToSign);

        $dataToSign = [];
        foreach ($fieldsToSign as $field) {
            $dataToSign[] = "$field=" . $payload[$field];
        }

        $signature = base64_encode(hash_hmac('sha256', implode(',', $dataToSign), env('SECURE_ACCEPTANCE_SECRET_KEY'), true));
        $payload['signature'] = $signature;

        // Отправляем POST-запрос
        $response = Http::asForm()->post(env('SECURE_ACCEPTANCE_API_URL'), $payload);
        
        try {
            $response = Http::asForm()->post(env('SECURE_ACCEPTANCE_API_URL'), $payload);

            \Log::info('🔁 Test Payment Request', $payload);
            \Log::info('📥 Test Payment Response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            dd([
                'payload' => $payload,
                'response_status' => $response->status(),
                'response_body' => $response->body()
            ]);

        } catch (\Exception $e) {
            dd([
                'payload' => $payload,
                'error' => $e->getMessage()
            ]);
        }

        
        return response()->json([
            'status' => $response->status(),
            'body' => $response->json(),
        ]);
    }

}
