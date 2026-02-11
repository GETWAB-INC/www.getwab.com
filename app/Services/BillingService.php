<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use App\Models\BillingRecord;
use App\Models\ReportPackage;

class BillingService
{
    /**
     * Trial tokenization flow:
     * - expected to save payment_token / instrument_identifier_id
     * - and activate trial subscription
     *
     * Return format MUST match other service methods:
     * ['success' => bool, 'messages' => string[]]
     */
    public function processTrialTokenization(array $pending, array $paymentMeta): array
    {
        $userId = $pending['user_id'] ?? null;
        if (!$userId) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        // Главный ID для будущих списаний (самое важное поле)
        $paymentInstrumentId = (string)($paymentMeta['payment_token_payment_instrument_id'] ?? '');
        if ($paymentInstrumentId === '') {
            return [
                'success' => false,
                'messages' => ['Tokenization succeeded, but payment_token_payment_instrument_id is missing.'],
            ];
        }

        // Остальные идентификаторы
        $provider = (string)($paymentMeta['provider'] ?? 'boa');
        $token = (string)($paymentMeta['payment_token'] ?? ''); // legacy token (не используем как primary key)
        $customerId = (string)($paymentMeta['payment_token_customer_id'] ?? '');
        $instrumentIdentifierId = (string)($paymentMeta['payment_token_instrument_identifier_id'] ?? '');
        $par = (string)($paymentMeta['payment_account_reference'] ?? '');
        $requestToken = (string)($paymentMeta['request_token'] ?? '');

        // UI-атрибуты карты
        $brand = (string)($paymentMeta['card_type_name'] ?? $paymentMeta['brand'] ?? '');
        $masked = (string)($paymentMeta['req_card_number'] ?? '');
        $last4 = null;
        if (preg_match('/(\d{4})$/', $masked, $m)) {
            $last4 = $m[1];
        }

        // Expiry: у тебя приходит "02-2029" (или может быть "02/2029")
        $expMonth = null;
        $expYear = null;
        $expRaw = (string)($paymentMeta['req_card_expiry_date'] ?? '');
        if ($expRaw !== '') {
            // нормализуем разделитель
            $expRaw2 = str_replace('/', '-', $expRaw);
            if (preg_match('/^(\d{2})-(\d{4})$/', $expRaw2, $mm)) {
                $expMonth = (int)$mm[1];
                $expYear = (int)$mm[2];
            }
        }

        try {
            DB::transaction(function () use (
                $userId, $provider, $token, $customerId, $paymentInstrumentId,
                $instrumentIdentifierId, $par, $requestToken,
                $brand, $last4, $expMonth, $expYear, $paymentMeta
            ) {
                // Если у юзера ещё нет default метода — этот станет default
                $hasDefault = DB::table('payment_methods')
                    ->where('user_id', $userId)
                    ->where('provider', $provider)
                    ->whereNull('deleted_at')
                    ->where('is_active', 1)
                    ->where('is_default', 1)
                    ->exists();

                $isDefault = $hasDefault ? 0 : 1;

                // Upsert по уникальному индексу uq_pm_provider_payment_instrument(provider, payment_instrument_id)
                // Laravel: updateOrInsert делает INSERT либо UPDATE по matching where
                DB::table('payment_methods')->updateOrInsert(
                    [
                        'provider' => $provider,
                        'payment_instrument_id' => $paymentInstrumentId,
                    ],
                    [
                        'user_id' => $userId,

                        // legacy token оставляем (может быть пустым)
                        'token' => ($token !== '' ? $token : null),

                        'customer_id' => ($customerId !== '' ? $customerId : null),
                        'instrument_identifier_id' => ($instrumentIdentifierId !== '' ? $instrumentIdentifierId : null),
                        'payment_account_reference' => ($par !== '' ? $par : null),
                        'request_token' => ($requestToken !== '' ? $requestToken : null),

                        'last_four' => $last4,
                        'brand' => ($brand !== '' ? $brand : null),
                        'exp_month' => $expMonth,
                        'exp_year' => $expYear,

                        'is_default' => $isDefault,
                        'is_active' => 1,
                        'verified_at' => now(),

                        // meta у тебя LONGTEXT utf8mb4_bin — кладём JSON строкой
                        'meta' => json_encode($paymentMeta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),

                        'updated_at' => now(),
                        // created_at выставим только если записи ещё не было:
                        // для updateOrInsert это не автоматом, поэтому поставим, если NULL
                        'created_at' => DB::raw('COALESCE(created_at, NOW())'),
                    ]
                );

                // Если ты хочешь строгую логику "только один default":
                // - можно сбросить другие is_default=0 после вставки.
                // Но я не делаю это автоматически, чтобы не сломать текущие ожидания.
            });

            return [
                'success' => true,
                'messages' => ['Payment method saved to payment_methods (tokenization OK).'],
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'messages' => ['Failed to save payment method: ' . $e->getMessage()],
            ];
        }
    }


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

            $data['payment_provider'] = $paymentMeta['provider'] ?? 'boa';
            $data['reference_number'] = $paymentMeta['reference_number'] ?? ($pending['reference_number'] ?? null);
            $data['transaction_id'] = $paymentMeta['transaction_id'] ?? null;
            $data['request_token'] = $paymentMeta['request_token'] ?? null;
            $data['payment_token_instrument_identifier_id'] = $paymentMeta['payment_token_instrument_identifier_id'] ?? null;
            $data['payment_token_payment_instrument_id'] = $paymentMeta['payment_token_payment_instrument_id'] ?? null;
            $data['paid_amount'] = $paymentMeta['total'] ?? ($pending['total'] ?? null);

            // =========================
            // ✅ Card UI data for BillingRecord
            // Prefer payment_methods (saved tokenized card), fallback to gateway response
            // =========================

            // 0) get gateway last4/brand if present
            $gwBrand = (string)($paymentMeta['card_type_name'] ?? '');
            $gwLast4 = null;
            $masked = (string)($paymentMeta['req_card_number'] ?? '');
            if ($masked !== '' && preg_match('/(\d{4})$/', $masked, $m)) {
                $gwLast4 = $m[1];
            }

            // 1) try from payment_methods (exact by payment_instrument_id if provided; else default)
            $pmQuery = DB::table('payment_methods')
                ->where('user_id', $userId)
                ->where('provider', $data['payment_provider'])
                ->whereNull('deleted_at')
                ->where('is_active', 1);

            $piid = (string)($data['payment_token_payment_instrument_id'] ?? ''); // IMPORTANT: this is what you store as payment_instrument_id
            if ($piid !== '') {
                $pmQuery->where('payment_instrument_id', $piid);
            } else {
                $pmQuery->orderByDesc('is_default')
                    ->orderByDesc('verified_at')
                    ->orderByDesc('id');
            }

            $pm = $pmQuery->first();

            // 2) final values
            $data['card_last_four'] = $pm?->last_four ?: ($gwLast4 ?: null);
            $data['card_brand']     = $pm?->brand ?: ($gwBrand ?: null);

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
                DB::transaction(function () use ($data, $userId, $paymentMeta, &$results) {


                    $existingPackage = ReportPackage::where('user_id', $userId)
                        ->where('package_type', $data['package_type'])
                        ->first();

                        // =========================
                        // Resolve card UI data for billing (same logic as subscriptions)
                        // =========================

                        $provider = (string)($paymentMeta['provider'] ?? 'boa');

                        $pmQuery = DB::table('payment_methods')
                            ->where('user_id', $userId)
                            ->where('provider', $provider)
                            ->whereNull('deleted_at')
                            ->where('is_active', 1);

                        $piid = (string)($paymentMeta['payment_token_payment_instrument_id'] ?? '');

                        if ($piid !== '') {
                            $pmQuery->where('payment_instrument_id', $piid);
                        } else {
                            $pmQuery->orderByDesc('is_default')
                                ->orderByDesc('verified_at')
                                ->orderByDesc('id');
                        }

                        $pm = $pmQuery->first();

                    $billingRecord = BillingRecord::createRecord([
                        'user_id'        => $userId,
                        'package_type'   => $data['package_type'],
                        'reports_count'  => $data['reports_count'],
                        'package_price'  => $data['package_price'],

                        // ✅ add card data
                        'card_last_four' => $pm?->last_four,
                        'card_brand'     => $pm?->brand,

                        // желательно сохранить и transaction_id
                        'transaction_id' => $paymentMeta['transaction_id'] ?? null,
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
