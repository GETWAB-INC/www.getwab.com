<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function orderSubscription(Request $request)
    {

        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'subscription_plan' => 'required|in:Monthly,Annual',
        ]);


        $user = auth()->user();
        $existingSubscription = null;

        // Проверяем, авторизован ли пользователь
        if ($user) {
            // Только если пользователь есть — ищем подписку
            $existingSubscription = Subscription::where('user_id', $user->id)
                ->where('subscription_type', $validated['subscription_type'])
                ->first();
        }

        // Если подписка есть и она trial → редирект
        if ($existingSubscription && $existingSubscription->isCurrentlyTrial()) {
            return redirect()->route('account.subscription');
        }

        // Если подписка есть и она активная (не trial) → редирект
        if ($existingSubscription && !$existingSubscription->isCurrentlyTrial()) {
            return redirect()->route('account.subscription');
        }

        // Определяем статус подписки
        if (!$existingSubscription) {
            $subscriptionStatus = 'trial'; // Нет подписки → новый trial
        } else {
            $subscriptionStatus = $existingSubscription->isCurrentlyTrial() ? 'trial' : 'active';
        }

        $subscriptionType = $validated['subscription_type'];
        $subscriptionPlan = $validated['subscription_plan'];

        $prices = Subscription::PRICES;
        $totalPrice = $prices[$subscriptionType][$subscriptionPlan];

        // КРИТИЧЕСКОЕ ИЗМЕНЕНИЕ: для fpds_reports всегда устанавливаем статус 'active'
        if ($subscriptionType === 'fpds_reports') {
            $subscriptionStatus = 'active';
            // Для fpds_reports trial не предусмотрен → цена всегда платная
        }

        // Корректировка цены только для fpds_query с trial
        if ($subscriptionStatus === 'trial' && $subscriptionType === 'fpds_query') {
            $totalPrice = 0;
        }

        $orderData = [
            'subscription_type' => $subscriptionType,
            'subscription_status' => $subscriptionStatus,
            'subscription_price' => $totalPrice,
            'subscription_plan' => $subscriptionPlan,
        ];

        // Сохранение в сессию по типу и статусу
        if ($subscriptionType === 'fpds_query') {
            if ($subscriptionStatus === 'trial') {
                Session::put('fpds_query_trial', $orderData);
            } else {
                Session::put('fpds_query_subscription', $orderData);
            }
        } elseif ($subscriptionType === 'fpds_reports') {
            Session::put('fpds_report_subscription', $orderData);
        }

        return redirect()->route('checkout');
    }




    public function cancelSubscription(Request $request)
    {
        // 1. Валидация входных данных
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
        ]);

        $subscriptionType = $validated['subscription_type'];
        $userId = auth()->id();

        // 2. Поиск активной подписки пользователя
        $subscription = Subscription::where('user_id', $userId)
            ->where('subscription_type', $subscriptionType)
            ->whereIn('status', ['active', 'trial'])
            ->first();

        if (!$subscription) {
            return redirect()->back()->withErrors(['subscription' => 'Active subscription not found']);
        }

        // 3. Отмена подписки: обновление статуса и дат
        try {
            $subscription->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'updated_at' => now(),
            ]);

            // 4. Успешное завершение
            return redirect()->back()->withSuccess('Subscription cancelled successfully');
        } catch (\Exception $e) {
            Log::error('Subscription cancellation failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['subscription' => 'Failed to cancel subscription']);
        }
    }

    public function restoreSubscription(Request $request)
    {

        // 1. Валидация входных данных
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'new_plan' => 'required|in:Monthly,Annual',
        ]);

        $subscriptionType = $validated['subscription_type'];
        $newPlan = $validated['new_plan']; // 'Monthly'/'Annual'
        $userId = auth()->id();

        // 2. Поиск существующей подписки
        $subscription = Subscription::where('user_id', $userId)
            ->where('subscription_type', $subscriptionType)
            ->first();

        // 3. Проверяем, истекла ли подписка (включая trial)
        if ($subscription->isExpired()) {
            return redirect()->back()->withErrors(['subscription' => 'Subscription has expired. Please renew it.']);
        }

        // 4. Получаем цены из централизованной константы модели
        $prices = Subscription::PRICES;
        // 5. Нормализуем текущий план из БД
        $currentPlan = $subscription->plan;

        // 6. Получаем цену и частоту для нового плана
        $currentPrice = $prices[$subscriptionType][$newPlan];
        $subscriptionPlan = $newPlan; // 'Monthly' или 'Annual' — уже в нужном формате

        // 7. Логика восстановления
        if ($currentPlan === $newPlan) {
            // СЛУЧАЙ 1: план не изменился
            try {
                $subscription->updateSubscription(['status' => Subscription::STATUS_ACTIVE]);
                return redirect()->back()->withSuccess('Subscription restored successfully');
            } catch (\Exception $e) {
                Log::error('Subscription restore failed: ' . $e->getMessage());
                return redirect()->back()->withErrors(['subscription' => 'Failed to restore subscription']);
            }
        } else {
            // СЛУЧАЙ 2: план изменился
            if ($subscription->isFpdsQuerySubscription() && $subscription->isCurrentlyTrial()) {
                // ПОДСЛУЧАЙ 2.1: fpds_query в trial — обновляем без checkout
                try {
                    $subscription->updateSubscription(['plan' => $newPlan]);
                    return redirect()->back()->withSuccess('Trial plan updated successfully');
                } catch (\Exception $e) {
                    Log::error('Trial plan update failed: ' . $e->getMessage());
                    return redirect()->back()->withErrors(['subscription' => 'Failed to update trial plan']);
                }
            } elseif ($currentPlan !== $newPlan) {
                // ПОДСЛУЧАЙ 2.2: план изменился (не trial или не fpds_query) → на checkout
                $orderData = [
                    'subscription_type' => $subscriptionType,
                    'subscription_price' => $currentPrice,
                    'subscription_plan' => $subscriptionPlan,
                ];
                $sessionKey = match ($subscriptionType) {
                    'fpds_query' => 'fpds_query_subscription',
                    'fpds_reports' => 'fpds_report_subscription',
                    default => throw new \Exception('Unknown subscription type'),
                };
                Session::put($sessionKey, $orderData);
                return redirect()->route('checkout');
            } else {
                // ПОДСЛУЧАЙ 2.3: подписка уже активна — ошибка
                return redirect()->back()->withErrors(['subscription' => 'Subscription is already active']);
            }
        }
    }

    public function renewSubscription(Request $request)
    {
        $validated = $request->validate([
            'subscription_type' => 'required|in:fpds_query,fpds_reports',
            'new_plan' => 'required|in:Monthly,Annual',
        ]);

        $subscriptionType = $validated['subscription_type']; // 'fpds_query' или 'fpds_reports'
        $newPlan = $validated['new_plan']; // 'Monthly' или 'Annual'

        // Запрещаем триал для fpds_query
        if ($subscriptionType === 'fpds_query') {
            $subscriptionStatus = 'active';
        } else {
            // Для fpds_reports допускаем триал (если нужно в будущем)
            $subscriptionStatus = 'trial'; // или 'active' — зависит от логики
        }

        // В текущем контексте всегда 'active' для обоих типов
        $subscriptionStatus = 'active';

        // Получаем цены из модели Subscription
        $prices = Subscription::PRICES;
        $totalPrice = $prices[$subscriptionType][$newPlan];

        // Триал для fpds_query запрещён → цена всегда полная

        $orderData = [
            'subscription_type' => $subscriptionType,
            'subscription_status' => $subscriptionStatus,
            'subscription_price' => $totalPrice,
            'subscription_plan' => $newPlan,
        ];

        // Сохраняем в сессию: ключ зависит от типа подписки
        if ($subscriptionType === 'fpds_query') {
            Session::put('fpds_query_subscription', $orderData);
        } elseif ($subscriptionType === 'fpds_reports') {
            Session::put('fpds_report_subscription', $orderData);
        }

        return redirect()->route('checkout');
    }
}