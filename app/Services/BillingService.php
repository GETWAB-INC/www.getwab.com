<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Subscription;
use App\Models\BillingRecord;
use App\Models\ReportPackage;

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

    public function processReportPackage(): array
    {
        $results = [
            'success' => true,
            'messages' => [],
        ];

        // Ключи сессий для пакетов отчётов
        $sessionKeys = [
            'elementary_report_package',
            'composite_report_package'
        ];

        foreach ($sessionKeys as $sessionKey) {
            $data = Session::get($sessionKey);
            if (!$data) {
                $results['messages'][] = "No data for report package (key: {$sessionKey})";
                continue;
            }

            try {
                DB::transaction(function () use ($data, $sessionKey, &$results) {
                    // 1. Ищем существующий пакет у пользователя
                    $existingPackage = ReportPackage::where('user_id', auth()->id())
                        ->where('package_type', $data['package_type'])
                        ->first();

                    if ($existingPackage) {
                        // 2a. Если пакет есть — увеличиваем remaining_reports
                        $existingPackage->remaining_reports += $data['reports_count'];
                        $existingPackage->save();

                        // 2b. Создаём биллинговую запись (для учёта платежа)
                        $billingRecord = BillingRecord::createRecord([
                            'package_type' => $data['package_type'],
                            'reports_count' => $data['reports_count'],
                            'package_price' => $data['package_price'],
                        ]);

                        $results['messages'][] =
                            "Existing '{$data['package_type']}' package updated: +{$data['reports_count']} reports. Billing record #{$billingRecord->id} created.";
                    } else {
                        // 2c. Если пакета нет — создаём новую запись
                        $billingRecord = BillingRecord::createRecord([
                            'package_type' => $data['package_type'],
                            'reports_count' => $data['reports_count'],
                            'package_price' => $data['package_price'],
                        ]);

                        $reportPackage = ReportPackage::create([
                            'user_id' => auth()->id(),
                            'billing_record_id' => $billingRecord->id,
                            'package_type' => $data['package_type'],
                            'remaining_reports' => $data['reports_count'], // начальное количество
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $results['messages'][] =
                            "New '{$data['package_type']}' package created with {$data['reports_count']} reports. Billing record #{$billingRecord->id} created.";
                    }

                    // 3. Очищаем сессию
                    Session::forget($sessionKey);
                });
            } catch (\Exception $e) {
                $results['success'] = false;
                $results['messages'][] = "Failed to process report package (key: {$sessionKey}): {$e->getMessage()}";
            }
        }

        return $results;
    }
}
