<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    public function orderSubscription(Request $request)
    {
        // 1. Получаем входные данные
        $subscriptionType = $request->input('subscription_type');
        $subscriptionPriceKey = $request->input('subscription_price'); // 'monthly' или 'yearly'

        // 2. Определяем цены и частоту для типа подписки
        $prices = [
            'fpds_query' => [
                'monthly' => 49.00,
                'yearly' => 490.00,
            ],
            'fpds_reports' => [
                'monthly' => 799.00,
                'yearly' => 6490.00,
            ],
        ];

        $frequencies = [
            'monthly' => 'Monthly',
            'yearly' => 'Annual',
        ];

        // 3. Проверяем валидность типа подписки и периода
        if (!isset($prices[$subscriptionType])) {
            return redirect()->back()->withErrors(['subscription_type' => 'Invalid subscription type']);
        }

        if (!isset($prices[$subscriptionType][$subscriptionPriceKey])) {
            return redirect()->back()->withErrors(['subscription_price' => 'Invalid subscription period']);
        }

        // 4. Рассчитываем итоговую сумму
        $totalPrice = $prices[$subscriptionType][$subscriptionPriceKey];
        $frequency = $frequencies[$subscriptionPriceKey];

        // 5. Формируем данные для сессии
        $orderData = [
            'subscription_type' => $subscriptionType,
            'subscription_price' => $totalPrice,
            'subscription_frequency' => $frequency,
        ];

        // 6. Сохраняем в сессию под ключом, зависящим от типа подписки
        $sessionKey = match ($subscriptionType) {
            'fpds_query' => 'fpds_query_subscription',
            'fpds_reports' => 'fpds_report_subscription',
            default => throw new \Exception('Unknown subscription type'),
        };

        Session::put($sessionKey, $orderData);

        // 7. Перенаправляем на страницу checkout
        return redirect()->route('checkout');
    }
}
