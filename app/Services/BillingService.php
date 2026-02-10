<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use App\Models\BillingRecord;
use App\Models\ReportPackage;

class BillingService
{
    public function processSubscriptions(array $pending = [], array $paymentMeta = []): array
    {
        $results = ['success' => true, 'messages' => []];

        $userId = $pending['user_id'] ?? null;
        $payloads = $pending['payloads'] ?? [];

        if (!$userId) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        $keys = ['fpds_query_trial','fpds_query_subscription','fpds_report_subscription'];

        $processedAny = false;

        foreach ($keys as $key) {
            $data = $payloads[$key] ?? null;

            if (!$data) {
                // это НЕ ошибка, просто нет такого товара в pending
                continue;
            }

            $processedAny = true;

            // ✅ обогащаем данными платежа и пользователя (для BillingRecord/Subscription)
            $data['user_id'] = $userId;
            $data['email'] = $pending['email'] ?? null;

            $data['payment_provider'] = $paymentMeta['type'] ?? 'unknown';
            $data['reference_number'] = $paymentMeta['reference_number'] ?? ($pending['reference_number'] ?? null);
            $data['transaction_id'] = $paymentMeta['transaction_id'] ?? null;
            $data['request_token'] = $paymentMeta['request_token'] ?? null;
            $data['payment_token_instrument_identifier_id'] = $paymentMeta['payment_token_instrument_identifier_id'] ?? null;
            $data['paid_amount'] = $paymentMeta['total'] ?? ($pending['total'] ?? null);

            try {
                DB::transaction(function () use ($data, $key, &$results) {
                    $billingRecord = BillingRecord::createRecord($data);

                    $data['billing_record_id'] = $billingRecord->id;

                    Subscription::store($data);

                    $results['messages'][] = "Subscription '{$key}' and billing record #{$billingRecord->id} created successfully.";
                });
            } catch (\Exception $e) {
                $results['success'] = false;
                $results['messages'][] = "Failed to process subscription (key: {$key}): {$e->getMessage()}";
            }
        }

        // Если вообще ничего не обработали — это сигнал, что pending пустой/не тот
        if (!$processedAny) {
            $results['success'] = false;
            $results['messages'][] = 'No subscription payloads found in pending context.';
        }

        return $results;
    }


    public function processReportPackage(array $pending = [], array $paymentMeta = []): array
    {
        $results = ['success' => true, 'messages' => []];

        $userId = $pending['user_id'] ?? null;
        $payloads = $pending['payloads'] ?? [];

        if (!$userId) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        $keys = ['elementary_report_package','composite_report_package'];

        $processedAny = false;

        foreach ($keys as $key) {
            $data = $payloads[$key] ?? null;
            if (!$data) continue;

            $processedAny = true;

            try {
                DB::transaction(function () use ($data, $userId, &$results) {

                    $existingPackage = ReportPackage::where('user_id', $userId)
                        ->where('package_type', $data['package_type'])
                        ->first();

                    $billingRecord = BillingRecord::createRecord([
                        'user_id' => $userId,
                        'package_type' => $data['package_type'],
                        'reports_count' => $data['reports_count'],
                        'package_price' => $data['package_price'],
                    ]);

                    if ($existingPackage) {
                        $existingPackage->remaining_reports += $data['reports_count'];
                        $existingPackage->save();

                        $results['messages'][] =
                            "Existing '{$data['package_type']}' package updated: +{$data['reports_count']} reports. Billing record #{$billingRecord->id} created.";
                    } else {
                        ReportPackage::create([
                            'user_id' => $userId,
                            'billing_record_id' => $billingRecord->id,
                            'package_type' => $data['package_type'],
                            'remaining_reports' => $data['reports_count'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $results['messages'][] =
                            "New '{$data['package_type']}' package created with {$data['reports_count']} reports. Billing record #{$billingRecord->id} created.";
                    }
                });
            } catch (\Exception $e) {
                $results['success'] = false;
                $results['messages'][] = "Failed to process report package (key: {$key}): {$e->getMessage()}";
            }
        }

        // пакеты не обязаны быть в заказе — но если ты хочешь строгую проверку, оставь как в subscriptions
        return $results;
    }

}
