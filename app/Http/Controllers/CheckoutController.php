<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use App\Models\BillingRecord;
use Illuminate\Support\Facades\DB;

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
        // Переключатель тестового режима: true = успех, false = отказ
        $testMode = true; // Меняйте это значение для тестирования

        dd($request->all());

        // Определяем статус платежа на основе рубильника
        $paymentSuccessful = $testMode;

        if ($paymentSuccessful) {
            $fpds_query_subscription = Session::get('fpds_query_subscription');
            $fpds_report_subscription = Session::get('fpds_report_subscription');

            $composite_report_package = Session::get('composite_report_package');
            $elementary_report_package = Session::get('elementary_report_package');

            $single_elementary_report = Session::get('single_elementary_report');
            $single_composite_report = Session::get('single_composite_report');

            DB::transaction(function () use (
                $fpds_query_subscription,
                $fpds_report_subscription
            ) {
                // БЛОК 1: FPDS Query Subscription
                if ($fpds_query_subscription) {
                    // 1.1. Создаём запись в billing_records
                    $billingRecord = BillingRecord::create([
                        'user_id' => auth()->id(),
                        'billed_at' => now(),
                        'description' => 'FPDS Query Subscription',
                        'card_last_four' => '0000', // замените на реальные данные карты
                        'card_brand' => 'Unknown', // замените на реальный бренд карты
                        'amount' => $fpds_query_subscription['subscription_price'],
                        'currency' => 'USD',
                        'status' => 'completed',
                        'gateway_transaction_id' => null, // замените на ID из платёжного шлюза
                    ]);

                    // 1.2. Сохраняем подписку в subscriptions
                    $subscription = new Subscription();
                    $subscription->user_id = auth()->id();
                    $subscription->subscription_type = $fpds_query_subscription['subscription_type'];
                    $subscription->status = 'Active';
                    $subscription->plan = $fpds_query_subscription['subscription_frequency'];
                    $subscription->starts_at = now();
                    $subscription->next_billing_at = $subscription->calculateNextBillingDate();
                    $subscription->expires_at = null;
                    $subscription->amount = $fpds_query_subscription['subscription_price'];
                    $subscription->currency = 'USD';
                    $subscription->notes = "Subscription from billing #{$billingRecord->id}";
                    $subscription->save();

                    // 1.3. Очищаем сессию
                    Session::forget('fpds_query_subscription');
                }

                // БЛОК 2: FPDS Reports Subscription
                if ($fpds_report_subscription) {
                    // 2.1. Создаём запись в billing_records
                    $billingRecord = BillingRecord::create([
                        'user_id' => auth()->id(),
                        'billed_at' => now(),
                        'description' => 'FPDS Reports Subscription',
                        'card_last_four' => '0000',
                        'card_brand' => 'Unknown',
                        'amount' => $fpds_report_subscription['subscription_price'],
                        'currency' => 'USD',
                        'status' => 'completed',
                        'gateway_transaction_id' => null,
                    ]);

                    // 2.2. Сохраняем подписку в subscriptions
                    $subscription = new Subscription();
                    $subscription->user_id = auth()->id();
                    $subscription->subscription_type = $fpds_report_subscription['subscription_type'];
                    $subscription->status = 'Active';
                    $subscription->plan = $fpds_report_subscription['subscription_frequency'];
                    $subscription->starts_at = now();
                    $subscription->next_billing_at = $subscription->calculateNextBillingDate();
                    $subscription->expires_at = null;
                    $subscription->amount = $fpds_report_subscription['subscription_price'];
                    $subscription->currency = 'USD';
                    $subscription->notes = "Subscription from billing #{$billingRecord->id}";
                    $subscription->save();

                    // 2.3. Очищаем сессию
                    Session::forget('fpds_report_subscription');
                }
            });

            return view('thank-you');
        } else {
            return view('cancelled');
        }
    }
}
