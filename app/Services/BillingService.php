<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use App\Models\BillingRecord;

class BillingService
{
    public function processSubscriptions(): array
    {
        $results = [
            'success' => true,
            'messages' => [],
        ];

        // Ключи сессий, которые мы ожидаем
        $sessionKeys = [
            'fpds_query_trial',
            'fpds_query_subscription',
            'fpds_report_subscription',
        ];

        foreach ($sessionKeys as $sessionKey) {
            $data = Session::get($sessionKey);
            if (!$data) {
                $results['messages'][] = "No data for subscription (key: {$sessionKey})";
                continue;
            }

            try {
                DB::transaction(function () use ($data, $sessionKey, &$results) {
                    
                    // 1. Создаём биллинговую запись
                    $billingRecord = BillingRecord::createRecord($data);

                    // 2. Дополняем $data ID биллинговой записи для подписки
                    $data['billing_record_id'] = $billingRecord->id;
                    
                    // 3. Создаём подписку
                    Subscription::store($data);

                    // 4. Очищаем сессию
                    Session::forget($sessionKey);

                    // 5. Формируем сообщение — используем ключ сессии в описании
                    $results['messages'][] =
                        "Subscription '{$sessionKey}' and billing record #{$billingRecord->id} created successfully.";
                });
            } catch (\Exception $e) {
                $results['success'] = false;
                $results['messages'][] = "Failed to process subscription (key: {$sessionKey}): {$e->getMessage()}";
            }
        }

        return $results;
    }
}
