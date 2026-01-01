<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use App\Models\BillingRecord;
use Illuminate\Support\Facades\DB;
use App\Services\BillingService;


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
        // Переключатель тестового режима
        $testMode = true; // Меняйте это значение для тестирования

        if (!$testMode) {
            // Здесь будет реальная интеграция с платёжным шлюзом
            // Например: $paymentSuccessful = $this->paymentGateway->charge(...);
            $paymentSuccessful = false; // Заглушка
        } else {
            $paymentSuccessful = true;
        }
        
        if ($paymentSuccessful) {
            $billingService = new BillingService();
            $result = $billingService->processSubscriptions();

            if ($result['success']) {
                return view('thank-you')->with('messages', $result['messages']);
            } else {
                return view('cancelled')->with('errors', $result['messages']);
            }
        } else {
            return view('cancelled')->with('errors', ['Payment failed']);
        }
    }
}
