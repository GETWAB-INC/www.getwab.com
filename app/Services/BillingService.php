<?php

namespace App\Services;

use App\Models\BillingRecord;
use App\Models\ReportPackage;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillingService
{
    /**
     * Execute callback in a transaction only if there is no outer transaction.
     * This prevents partial commits when CheckoutController wraps the whole order.
     */
    private function inTransaction(callable $fn)
    {
        if (DB::transactionLevel() > 0) {
            return $fn();
        }

        return DB::transaction(function () use ($fn) {
            return $fn();
        });
    }

    /**
     * Normalize provider name from different meta keys used across the codebase.
     */
    private function resolveProvider(array $paymentMeta): string
    {
        $p = (string)($paymentMeta['provider'] ?? $paymentMeta['type'] ?? 'boa');
        return $p !== '' ? $p : 'boa';
    }

    /**
     * Extract last4 and brand from gateway meta (masked pan + card_type_name).
     */
    private function extractGatewayCardUi(array $paymentMeta): array
    {
        $gwBrand = (string)($paymentMeta['card_type_name'] ?? $paymentMeta['brand'] ?? '');
        $gwLast4 = null;

        $masked = (string)($paymentMeta['req_card_number'] ?? '');
        if ($masked !== '' && preg_match('/(\d{4})$/', $masked, $m)) {
            $gwLast4 = $m[1];
        }

        return [
            'brand' => ($gwBrand !== '' ? $gwBrand : null),
            'last4' => $gwLast4,
        ];
    }

    /**
     * Resolve card UI data via payment_methods (preferred) or gateway (fallback).
     * If payment_instrument_id exists, try exact match; otherwise pick default/most recent.
     */
    private function resolveCardUiFromPaymentMethods(
        int $userId,
        string $provider,
        ?string $paymentInstrumentId,
        array $paymentMeta
    ): array {
        $gw = $this->extractGatewayCardUi($paymentMeta);

        $pmQuery = DB::table('payment_methods')
            ->where('user_id', $userId)
            ->where('provider', $provider)
            ->whereNull('deleted_at')
            ->where('is_active', 1);

        if ($paymentInstrumentId) {
            $pmQuery->where('payment_instrument_id', $paymentInstrumentId);
        } else {
            $pmQuery->orderByDesc('is_default')
                ->orderByDesc('verified_at')
                ->orderByDesc('id');
        }

        $pm = $pmQuery->first();

        return [
            'card_last_four' => $pm?->last_four ?: ($gw['last4'] ?: null),
            'card_brand'     => $pm?->brand ?: ($gw['brand'] ?: null),
        ];
    }

    /**
     * Trial tokenization flow:
     * - save tokenized payment method to payment_methods
     * - does NOT create subscription itself (you can decide later); for now: store method only
     *
     * Return format:
     * ['success' => bool, 'messages' => string[]]
     */
    public function processTrialTokenization(array $pending, array $paymentMeta): array
    {
        $userId = (int)($pending['user_id'] ?? 0);
        if ($userId <= 0) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        // Primary identifier for future charges (most important field).
        $paymentInstrumentId = (string)($paymentMeta['payment_token_payment_instrument_id'] ?? '');
        if ($paymentInstrumentId === '') {
            return [
                'success' => false,
                'messages' => ['Tokenization succeeded, but payment_token_payment_instrument_id is missing.'],
            ];
        }

        $provider = $this->resolveProvider($paymentMeta);

        // Secondary identifiers (may be empty).
        $token                  = (string)($paymentMeta['payment_token'] ?? '');
        $customerId             = (string)($paymentMeta['payment_token_customer_id'] ?? '');
        $instrumentIdentifierId = (string)($paymentMeta['payment_token_instrument_identifier_id'] ?? '');
        $par                    = (string)($paymentMeta['payment_account_reference'] ?? '');
        $requestToken           = (string)($paymentMeta['request_token'] ?? '');

        // Card UI (brand / last4 / expiry).
        $brand  = (string)($paymentMeta['card_type_name'] ?? $paymentMeta['brand'] ?? '');
        $masked = (string)($paymentMeta['req_card_number'] ?? '');
        $last4 = null;
        if ($masked !== '' && preg_match('/(\d{4})$/', $masked, $m)) {
            $last4 = $m[1];
        }

        $expMonth = null;
        $expYear  = null;
        $expRaw = (string)($paymentMeta['req_card_expiry_date'] ?? '');
        if ($expRaw !== '') {
            $expRaw2 = str_replace('/', '-', $expRaw);
            if (preg_match('/^(\d{2})-(\d{4})$/', $expRaw2, $mm)) {
                $expMonth = (int)$mm[1];
                $expYear  = (int)$mm[2];
            }
        }

        try {
            $this->inTransaction(function () use (
                $userId, $provider, $token, $customerId, $paymentInstrumentId,
                $instrumentIdentifierId, $par, $requestToken,
                $brand, $last4, $expMonth, $expYear, $paymentMeta
            ) {
                // Compute whether user already has an active default.
                $hasDefault = DB::table('payment_methods')
                    ->where('user_id', $userId)
                    ->where('provider', $provider)
                    ->whereNull('deleted_at')
                    ->where('is_active', 1)
                    ->where('is_default', 1)
                    ->exists();

                $isDefault = $hasDefault ? 0 : 1;

                // ✅ SANITY: if we are about to set default=1, clear other defaults first (atomic inside transaction)
                if ($isDefault === 1) {
                    DB::table('payment_methods')
                        ->where('user_id', $userId)
                        ->where('provider', $provider)
                        ->whereNull('deleted_at')
                        ->update(['is_default' => 0]);
                }

                // Insert-first strategy preserves created_at reliably.
                try {
                    DB::table('payment_methods')->insert([
                        'user_id' => $userId,
                        'provider' => $provider,
                        'payment_instrument_id' => $paymentInstrumentId,

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

                        'meta' => json_encode($paymentMeta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),

                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } catch (\Throwable $e) {
                    // SQLSTATE 23000 = duplicate unique constraint
                    if ((string)($e->getCode() ?? '') !== '23000') {
                        throw $e;
                    }

                    // Duplicate means (provider, payment_instrument_id) already exists.
                    // We should NOT blow away someone else's default unless we intend to make THIS one default.
                    // Re-check default at the moment of update (safer under concurrency).
                    $hasDefaultNow = DB::table('payment_methods')
                        ->where('user_id', $userId)
                        ->where('provider', $provider)
                        ->whereNull('deleted_at')
                        ->where('is_active', 1)
                        ->where('is_default', 1)
                        ->exists();

                    if (!$hasDefaultNow) {
                        // ✅ No default exists now → make this one default and clear others first.
                        DB::table('payment_methods')
                            ->where('user_id', $userId)
                            ->where('provider', $provider)
                            ->whereNull('deleted_at')
                            ->update(['is_default' => 0]);
                    }

                    DB::table('payment_methods')
                        ->where('provider', $provider)
                        ->where('payment_instrument_id', $paymentInstrumentId)
                        ->update([
                            'user_id' => $userId,

                            'token' => ($token !== '' ? $token : null),
                            'customer_id' => ($customerId !== '' ? $customerId : null),
                            'instrument_identifier_id' => ($instrumentIdentifierId !== '' ? $instrumentIdentifierId : null),
                            'payment_account_reference' => ($par !== '' ? $par : null),
                            'request_token' => ($requestToken !== '' ? $requestToken : null),

                            'last_four' => $last4,
                            'brand' => ($brand !== '' ? $brand : null),
                            'exp_month' => $expMonth,
                            'exp_year' => $expYear,

                            // If a default already exists, keep whatever is currently stored.
                            // If none exists, force this one to become default.
                            'is_default' => $hasDefaultNow ? DB::raw('is_default') : 1,

                            'is_active' => 1,
                            'verified_at' => now(),

                            'meta' => json_encode($paymentMeta, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                            'updated_at' => now(),
                        ]);
                }
            });

            return [
                'success' => true,
                'messages' => ['Payment method saved (tokenization OK).'],
            ];
        } catch (\Throwable $e) {
            Log::channel('checkout')->error('processTrialTokenization failed', [
                'user_id' => $userId,
                'provider' => $provider,
                'payment_instrument_id' => $paymentInstrumentId,
                'error' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'messages' => ['Failed to save payment method: ' . $e->getMessage()],
            ];
        }
    }


    /**
     * Subscription purchase flow:
     * - create BillingRecord
     * - create Subscription
     * Atomicity:
     * - If called under an outer transaction: throws => outer rollback.
     * - If called standalone: wrapped into a transaction.
     */
    public function processSubscriptions(array $pending = [], array $paymentMeta = []): array
    {
        $userId = (int)($pending['user_id'] ?? 0);
        if ($userId <= 0) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        $payloads = (array)($pending['payloads'] ?? []);
        $provider = $this->resolveProvider($paymentMeta);

        $keys = ['fpds_query_subscription', 'fpds_report_subscription'];

        try {
            return $this->inTransaction(function () use ($keys, $payloads, $pending, $paymentMeta, $userId, $provider) {
                $messages = [];
                $processedAny = false;

                foreach ($keys as $key) {
                    $data = $payloads[$key] ?? null;
                    if (!$data) {
                        continue;
                    }

                    $processedAny = true;

                    // Enrich with billing/payment context.
                    $data['user_id'] = $userId;
                    $data['email'] = $pending['email'] ?? null;

                    $ref = (string)($paymentMeta['reference_number'] ?? ($pending['reference_number'] ?? ''));
                    if ($ref === '') {
                        throw new \RuntimeException('Missing reference_number for checkout purchase (flow=pay).');
                    }

                    $data['payment_provider']  = $provider;
                    $data['flow']              = 'pay';          // ✅ canonical: checkout purchase
                    $data['reference_number']  = $ref;           // ✅ single source of truth

                    $data['transaction_id']    = $paymentMeta['transaction_id'] ?? null;
                    $data['request_token']     = $paymentMeta['request_token'] ?? null;

                    $data['payment_token_instrument_identifier_id'] = $paymentMeta['payment_token_instrument_identifier_id'] ?? null;
                    $data['payment_token_payment_instrument_id']    = $paymentMeta['payment_token_payment_instrument_id'] ?? null;
                    $data['paid_amount']       = $paymentMeta['total'] ?? ($pending['total'] ?? null);


                    // Resolve card UI data for BillingRecord (payment_methods -> gateway fallback).
                    $piid = (string)($data['payment_token_payment_instrument_id'] ?? '');
                    $ui = $this->resolveCardUiFromPaymentMethods(
                        $userId,
                        $provider,
                        ($piid !== '' ? $piid : null),
                        $paymentMeta
                    );

                    $data['card_last_four'] = $ui['card_last_four'];
                    $data['card_brand']     = $ui['card_brand'];

                    // Create billing record + subscription.
                    // IMPORTANT: Do not swallow exceptions here; we want full rollback.
                    $billingRecord = BillingRecord::createRecord($data);
                    $data['billing_record_id'] = $billingRecord->id;

                    Subscription::store($data);

                    $messages[] = "Subscription '{$key}' and billing record #{$billingRecord->id} created successfully.";
                }

                if (!$processedAny) {
                    return ['success' => false, 'messages' => ['No subscription payloads found in pending context.']];
                }

                return ['success' => true, 'messages' => $messages];
            });
        } catch (\Throwable $e) {
            Log::channel('checkout')->error('processSubscriptions failed', [
                'user_id' => $userId,
                'provider' => $provider,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'messages' => ['Failed to process subscriptions: ' . $e->getMessage()]];
        }
    }

    /**
     * Report package purchase flow:
     * - create BillingRecord
     * - create or update ReportPackage
     * Atomicity same as subscriptions.
     */
    public function processReportPackage(array $pending = [], array $paymentMeta = []): array
    {
        $userId = (int)($pending['user_id'] ?? 0);
        if ($userId <= 0) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        $payloads = (array)($pending['payloads'] ?? []);
        $provider = $this->resolveProvider($paymentMeta);

        $keys = ['elementary_report_package', 'composite_report_package'];

        try {
            return $this->inTransaction(function () use ($keys, $payloads, $pending, $userId, $paymentMeta, $provider) {
                $messages = [];
                $processedAny = false;

                foreach ($keys as $key) {
                    $data = $payloads[$key] ?? null;
                    if (!$data) {
                        continue;
                    }

                    $processedAny = true;

                    $packageType  = (string)($data['package_type'] ?? '');
                    $reportsCount = (int)($data['reports_count'] ?? 0);
                    $packagePrice = (string)($data['package_price'] ?? '0.00');

                    if ($packageType === '' || $reportsCount <= 0) {
                        throw new \RuntimeException("Invalid package payload for '{$key}'.");
                    }

                    // Resolve card UI data (payment_methods -> gateway fallback).
                    $piid = (string)($paymentMeta['payment_token_payment_instrument_id'] ?? '');

                    $ref = (string)($paymentMeta['reference_number'] ?? ($pending['reference_number'] ?? ''));
                    if ($ref === '') {
                        throw new \RuntimeException('Missing reference_number for report package purchase (flow=pay).');
                    }

                    $ui = $this->resolveCardUiFromPaymentMethods(
                        $userId,
                        $provider,
                        ($piid !== '' ? $piid : null),
                        $paymentMeta
                    );

                    // Create billing record for the package.
                    $ref = (string)($paymentMeta['reference_number'] ?? ($pending['reference_number'] ?? ''));
                    if ($ref === '') {
                        throw new \RuntimeException('Missing reference_number for report package purchase (flow=pay).');
                    }

                    $billingRecord = BillingRecord::createRecord([
                        'user_id'           => $userId,
                        'package_type'      => $packageType,
                        'reports_count'     => $reportsCount,
                        'package_price'     => $packagePrice,

                        'card_last_four'    => $ui['card_last_four'],
                        'card_brand'        => $ui['card_brand'],

                        'payment_provider'  => $provider,
                        'flow'              => 'pay',   // ✅ canonical
                        'reference_number'  => $ref,    // ✅ canonical

                        'transaction_id'    => $paymentMeta['transaction_id'] ?? null,
                    ]);

                    // Upsert report package (add remaining reports).
                    $existing = ReportPackage::where('user_id', $userId)
                        ->where('package_type', $packageType)
                        ->first();

                    if ($existing) {
                        $existing->remaining_reports += $reportsCount;
                        $existing->save();

                        $messages[] =
                            "Existing '{$packageType}' package updated: +{$reportsCount} reports. Billing record #{$billingRecord->id} created.";
                    } else {
                        ReportPackage::create([
                            'user_id'          => $userId,
                            'billing_record_id'=> $billingRecord->id,
                            'package_type'     => $packageType,
                            'remaining_reports'=> $reportsCount,
                            'created_at'       => now(),
                            'updated_at'       => now(),
                        ]);

                        $messages[] =
                            "New '{$packageType}' package created with {$reportsCount} reports. Billing record #{$billingRecord->id} created.";
                    }
                }

                // ✅ ВАЖНО: если пакетов не было — это "нет payload", а не success
                if (!$processedAny) {
                    return ['success' => false, 'messages' => ['No report package payload found in pending context.']];
                }

                return ['success' => true, 'messages' => $messages];
            });
        } catch (\Throwable $e) {
            Log::channel('checkout')->error('processReportPackage failed', [
                'user_id' => $userId,
                'provider' => $provider,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'messages' => ['Failed to process report package: ' . $e->getMessage()]];
        }
    }

    /**
     * TRIAL subscription flow (NO MONEY):
     * - create/update Subscription with status='trial', plan='monthly|annual'
     * - DO NOT create BillingRecord
     * Atomicity: same inTransaction contract as others.
     */
    public function processTrialSubscriptions(array $pending = [], array $paymentMeta = []): array
    {
        $userId = (int)($pending['user_id'] ?? 0);
        if ($userId <= 0) {
            return ['success' => false, 'messages' => ['Missing user_id in pending context.']];
        }

        $payloads = (array)($pending['payloads'] ?? []);
        $keys = ['fpds_query_trial']; // trial only

        try {
            return $this->inTransaction(function () use ($keys, $payloads, $userId, $paymentMeta) {

                $messages = [];
                $processedAny = false;

                foreach ($keys as $key) {
                    $data = $payloads[$key] ?? null;
                    if (!$data) {
                        continue;
                    }

                    $processedAny = true;

                    // minimal required fields for Subscription::store
                    $data['user_id'] = $userId;

                    // Force TRIAL canonical status (trial is STATUS, not PLAN)
                    $data['subscription_status'] = 'trial';
                    $data['status'] = 'trial';

                    // PLAN must be monthly|annual (from payload)
                    $planIn = (string)($data['subscription_plan'] ?? $data['plan'] ?? '');
                    $plan   = \App\Models\Subscription::normalizePlan($planIn);

                    Log::channel('checkout')->info('trial payload plan', [
                        'user_id'   => $userId,
                        'plan_in'   => $planIn,
                        'plan_norm' => $plan,
                    ]);

                    // fallback (если почему-то payload пустой)
                    if (!in_array($plan, ['monthly', 'annual'], true)) {
                        $plan = 'monthly';
                    }

                    $data['subscription_plan'] = $plan;
                    $data['plan'] = $plan;


                    // Critical: NO billing record for trial
                    $data['billing_record_id'] = null;

                    // keep gateway traceability (robust fallback for different key names)
                    $gwId = (string)(
                        $paymentMeta['transaction_id']
                        ?? $paymentMeta['transactionId']
                        ?? $paymentMeta['TransactionID']
                        ?? ''
                    );

                    if ((!isset($data['payment_gateway_id']) || $data['payment_gateway_id'] === '') && $gwId !== '') {
                        $data['payment_gateway_id'] = $gwId;
                    }

                    Subscription::store($data);

                    $messages[] = "Trial subscription '{$key}' created successfully (no billing record).";
                }

                if (!$processedAny) {
                    return ['success' => false, 'messages' => ['No trial subscription payload found in pending context.']];
                }

                return ['success' => true, 'messages' => $messages];
            });
        } catch (\Throwable $e) {
            Log::channel('checkout')->error('processTrialSubscriptions failed', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
            ]);

            return ['success' => false, 'messages' => ['Failed to process trial subscription: ' . $e->getMessage()]];
        }
    }

}
