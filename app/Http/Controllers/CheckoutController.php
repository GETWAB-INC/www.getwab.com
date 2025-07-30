<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $accessKey = 'abd7db4aaf5a318ebbc44297b3528a0c';
        $profileId = '069E822B-906F-43F1-B7D1-57DE588E9AEF';
        $secretKey = 'a10e614ffbc24c49a26f761f331e856d796f7a33d1814829b67a144b2b0858972882a25998ae4d5886061fa692e64dffec8d356da72f4372915322e7c9ca63cd7d0c55b8455e40c19bd345bee8d515367d0206524eae4beea274ec96ce477f373dcf82515cbf417daf8697523e593b7763e2a38c6fff4b2ba210c3412e3774d9';

        return view('checkout.form', [
            'access_key' => $accessKey,
            'profile_id' => $profileId,
            'secret_key' => $secretKey,
        ]);
    }

    public function handleResponse(Request $request)
    {
        // Получаем все поля
        $data = $request->all();

        // Логируем в storage/logs/laravel.log
        Log::info('BoA Transaction Response', $data);

        // Для отладки — выводим на экран (временно, не оставляй в продакшене)
        echo "<pre>";
        print_r($data);
        echo "</pre>";

        // Можно вернуть простой ответ
        return response('OK');
    }
}

