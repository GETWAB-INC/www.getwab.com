<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Subscription extends Model
{
    use SoftDeletes;

    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'subscription_type',
        'status',
        'plan',
        'start_at',
        'next_billing_at',
        'expires_at',
        'trial_start_at',
        'trial_end_at',
        'cancelled_at',
        'amount',
        'currency',
        'payment_gateway_id',
        'notes',
        'renew_attempts',
        'renew_next_attempt_at',
        'renew_last_error',
        'past_due_at',
        'grace_until',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_at' => 'datetime',
        'next_billing_at' => 'datetime',
        'expires_at' => 'datetime',
        'trial_start_at' => 'datetime',
        'trial_end_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'renew_attempts' => 'integer',
        'renew_next_attempt_at' => 'datetime',
        'past_due_at' => 'datetime',
        'grace_until' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];


    public const PLAN_TRIAL   = 'trial';
    public const PLAN_MONTHLY = 'monthly';
    public const PLAN_ANNUAL  = 'annual';

    public const VALID_PLANS = [
        self::PLAN_TRIAL,
        self::PLAN_MONTHLY,
        self::PLAN_ANNUAL,
    ];

    public static function normalizePlan(?string $plan): string
    {
        $p = strtolower(trim((string)$plan));

        return match ($p) {
            'monthly', 'month', 'm' => self::PLAN_MONTHLY,
            'annual', 'yearly', 'year', 'y' => self::PLAN_ANNUAL,
            'trial' => self::PLAN_TRIAL,
            default => $p,
        };
    }

    public const STATUS_ACTIVE = 'active';
    public const STATUS_TRIAL = 'trial';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_SUSPENDED = 'suspended';
    public const STATUS_PAST_DUE = 'past_due';


    public const VALID_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_TRIAL,
        self::STATUS_CANCELLED,
        self::STATUS_EXPIRED,
        self::STATUS_SUSPENDED,
        self::STATUS_PAST_DUE,
    ];

    public const PRICES = [
        'fpds_query' => [
            'monthly' => 1.00,
            'annual'  => 490.00,
        ],
        'fpds_reports' => [
            'monthly' => 799.00,
            'annual'  => 6490.00,
        ],
    ];

    protected $attributes = [
        'currency' => 'USD',
        'status' => self::STATUS_TRIAL,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isTrial(): bool
    {
        return $this->status === self::STATUS_TRIAL;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isExpired(): bool
    {
        return $this->status === self::STATUS_EXPIRED;
    }

    public function isCancelled(): bool
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function isSuspended(): bool
    {
        return $this->status === self::STATUS_SUSPENDED;
    }

    public function isCurrentlyTrial(): bool
    {
        return $this->status === self::STATUS_TRIAL
            && $this->trial_end_at !== null
            && now()->lte($this->trial_end_at);
    }

    public function isCurrentlyActive(): bool
    {
        return !$this->expires_at || now() <= $this->expires_at;
    }

    /**
     * Checks whether the subscription is of type 'fpds_query'.
     *
     * @return bool True if the subscription type is 'fpds_query', otherwise false.
     */
    public function isFpdsQuerySubscription(): bool
    {
        return $this->subscription_type === 'fpds_query';
    }

    /**
     * Checks whether the subscription is of type 'fpds_reports'.
     *
     * @return bool True if the subscription type is 'fpds_reports', otherwise false.
     */
    public function isFpdsReportsSubscription(): bool
    {
        return $this->subscription_type === 'fpds_reports';
    }

    public function renew(): void
    {
        $this->next_billing_at = $this->calculateNextBillingDate();
        $this->save();
    }

    /**
     * Activate the subscription (switch from trial to active).
     */
    public function activate(): void
    {
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }

    /**
     * Cancel the subscription.
     */
    public function cancel(): void
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    /**
     * Suspend the subscription.
     */
    public function suspend(): void
    {
        $this->status = self::STATUS_SUSPENDED;
        $this->save();
    }

    /**
     * Mark the subscription as expired.
     */
    public function markAsExpired(): void
    {
        $this->status = self::STATUS_EXPIRED;
        $this->save();
    }

    public function billingBaseDate(): \Carbon\Carbon
    {
        $now = now();

        // если подписка ещё активна — продляем от текущего expires_at
        if ($this->expires_at && $this->expires_at->greaterThan($now)) {
            return $this->expires_at->copy();
        }

        // если истекла — продляем от сейчас
        return $now;
    }

    // ADDED: calculate next billing date
    public function calculateNextBillingDate(): \Carbon\Carbon
    {
        $base = $this->billingBaseDate();

        return match (self::normalizePlan($this->plan)) {
            self::PLAN_MONTHLY => $base->copy()->addMonth(),
            self::PLAN_ANNUAL  => $base->copy()->addYear(),
            default            => $base->copy()->addMonth(),
        };
    }

    public function setPlanAttribute($value): void
    {
        $this->attributes['plan'] = self::normalizePlan((string)$value);
    }

    // ADDED: calculate subscription expiration date
    public function calculateExpireDate(): \Carbon\Carbon
    {
        // expires_at обычно совпадает с next_billing_at (если у тебя так задумано)
        return $this->calculateNextBillingDate();
    }

    public static function store(array $data): Subscription
    {
        $subscriptionType   = (string)($data['subscription_type'] ?? '');
        $subscriptionStatus = (string)($data['subscription_status'] ?? $data['status'] ?? '');
        $subscriptionPlanIn = (string)($data['subscription_plan'] ?? $data['plan'] ?? '');
        $billingRecordId    = $data['billing_record_id'] ?? null;

        // NEW: keep gateway transaction id if provided (do NOT wipe it)
        $gatewayId = (string)($data['payment_gateway_id']
            ?? $data['gateway_transaction_id']
            ?? $data['transaction_id']
            ?? '');

        $userId = (int)($data['user_id'] ?? 0);
        if ($userId <= 0) {
            throw new \InvalidArgumentException('Missing user_id for Subscription::store');
        }
        if ($subscriptionType === '' || $subscriptionStatus === '') {
            throw new \InvalidArgumentException('Missing subscription fields for Subscription::store');
        }

        // Normalize status + plan
        $subscriptionStatus = strtolower(trim($subscriptionStatus));

        // ✅ Plan normalization (always store lowercase: trial/monthly/annual)
        // Trial forces plan=trial even if incoming is Monthly/Annual.
        if ($subscriptionStatus === self::STATUS_TRIAL || $subscriptionStatus === 'trial') {
            $subscriptionPlan = self::PLAN_TRIAL;
        } else {
            if ($subscriptionPlanIn === '') {
                throw new \InvalidArgumentException('Missing subscription_plan for Subscription::store');
            }
            $subscriptionPlan = self::normalizePlan($subscriptionPlanIn);

            if (!in_array($subscriptionPlan, self::VALID_PLANS, true) || $subscriptionPlan === self::PLAN_TRIAL) {
                throw new \InvalidArgumentException('Invalid subscription_plan for Subscription::store: ' . $subscriptionPlanIn);
            }
        }

        $now = now();

        // 1) Try to load existing row under lock
        $subscription = self::where('user_id', $userId)
            ->where('subscription_type', $subscriptionType)
            ->lockForUpdate()
            ->first();

        $isNew = false;
        if (!$subscription) {
            $subscription = new self();
            $subscription->user_id = $userId;
            $subscription->subscription_type = $subscriptionType;
            $subscription->start_at = $now;
            $isNew = true;
        }

        $subscription->billing_record_id = $billingRecordId;
        $subscription->status = $subscriptionStatus;
        $subscription->plan = $subscriptionPlan; // ✅ always lowercase
        $subscription->cancelled_at = null;

        // ✅ CANON: успешная оплата (pay/renew success) должна “очистить хвосты” delinquency.
        // store() вызывается на успешной оплате, поэтому для non-trial принудительно сбрасываем.
        if ($subscriptionPlan !== self::PLAN_TRIAL && $subscriptionStatus !== self::STATUS_TRIAL && $subscriptionStatus !== 'trial') {
            // статус должен быть active (если оплата прошла)
            $subscription->status = self::STATUS_ACTIVE;

            // сброс retry/delinquency
            $subscription->renew_attempts = 0;
            $subscription->renew_next_attempt_at = null;
            $subscription->renew_last_error = null;

            $subscription->past_due_at = null;
            $subscription->grace_until = null;
        }


        // Dates
        if ($subscriptionPlan === self::PLAN_TRIAL || $subscriptionStatus === self::STATUS_TRIAL || $subscriptionStatus === 'trial') {
            $subscription->trial_start_at   = $now;
            $subscription->trial_end_at     = $now->copy()->addDays(7);
            $subscription->next_billing_at  = $now->copy()->addDays(7);
            $subscription->expires_at       = $now->copy()->addDays(7);
        } else {
            $subscription->next_billing_at = $subscription->calculateNextBillingDate();
            $subscription->expires_at      = $subscription->calculateExpireDate();
            // trial_* можно не трогать (история), либо обнулять — я оставляю как есть
        }

        // Amount
        if ($subscriptionPlan === self::PLAN_TRIAL || $subscriptionStatus === self::STATUS_TRIAL || $subscriptionStatus === 'trial') {
            $subscription->amount = 0.00;
        } else {
            $subscription->amount = (float)(self::PRICES[$subscriptionType][$subscriptionPlan] ?? 0.00);
        }

        $subscription->currency = 'USD';

        // NEW: only set if provided, otherwise keep previous value
        if ($gatewayId !== '') {
            $subscription->payment_gateway_id = $gatewayId;
        }

        $subscription->notes = $isNew
            ? "Subscription linked to billing #{$billingRecordId}"
            : "Subscription updated, linked to billing #{$billingRecordId}";


        try {
            $subscription->save();
            return $subscription;
        } catch (\Throwable $e) {
            // 2) If unique race (duplicate insert), reload existing under lock and update
            if ((string)($e->getCode() ?? '') === '23000') {
                $existing = self::where('user_id', $userId)
                    ->where('subscription_type', $subscriptionType)
                    ->lockForUpdate()
                    ->first();

                if ($existing) {

                    $existing->billing_record_id = $billingRecordId;
                    $existing->status = $subscriptionStatus;
                    $existing->plan = $subscriptionPlan; // ✅ lowercase
                    $existing->cancelled_at = null;

                    // ✅ CANON: успешная оплата очищает delinquency-поля
                    if ($subscriptionPlan !== self::PLAN_TRIAL && $subscriptionStatus !== self::STATUS_TRIAL && $subscriptionStatus !== 'trial') {
                        $existing->status = self::STATUS_ACTIVE;

                        $existing->renew_attempts = 0;
                        $existing->renew_next_attempt_at = null;
                        $existing->renew_last_error = null;

                        $existing->past_due_at = null;
                        $existing->grace_until = null;
                    }


                    if ($subscriptionPlan === self::PLAN_TRIAL || $subscriptionStatus === self::STATUS_TRIAL || $subscriptionStatus === 'trial') {
                        $existing->trial_start_at   = $now;
                        $existing->trial_end_at     = $now->copy()->addDays(7);
                        $existing->next_billing_at  = $now->copy()->addDays(7);
                        $existing->expires_at       = $now->copy()->addDays(7);
                        $existing->amount           = 0.00;
                    } else {
                        $existing->next_billing_at = $existing->calculateNextBillingDate();
                        $existing->expires_at      = $existing->calculateExpireDate();
                        $existing->amount          = (float)(self::PRICES[$subscriptionType][$subscriptionPlan] ?? 0.00);
                    }

                    $existing->currency = 'USD';

                    // NEW: only set if provided, otherwise keep previous value
                    if ($gatewayId !== '') {
                        $existing->payment_gateway_id = $gatewayId;
                    }

                    $existing->notes = "Subscription updated after unique race, linked to billing #{$billingRecordId}";

                    $existing->save();

                    return $existing;
                }
            }

            Log::error('Failed to save/update subscription in store', [
                'error_message'     => $e->getMessage(),
                'exception_class'   => get_class($e),
                'user_id'           => $userId,
                'subscription_type' => $subscriptionType,
                'subscription_plan' => $subscriptionPlan,
                'subscription_status' => $subscriptionStatus,
                'billing_record_id' => $billingRecordId,
            ]);

            throw $e;
        }
    }


    /**
     * Updates the subscription and recalculates dates and status.
     *
     * @param array $data Data to update: ['plan' => ..., 'status' => ...]
     * @return bool True on success, false on failure
     */
    public function updateSubscription(array $data): bool
    {
        $now = now();

        // Normalize incoming values (plan/status)
        $incomingPlan   = $data['plan']   ?? $this->plan;
        $incomingStatus = $data['status'] ?? $this->status;

        $incomingStatus = strtolower(trim((string)$incomingStatus));
        $normalizedPlan = self::normalizePlan((string)$incomingPlan);

        // ✅ Enforce single canonical plan format in DB: trial/monthly/annual
        // If status is trial → plan MUST be 'trial'
        if ($incomingStatus === self::STATUS_TRIAL || $incomingStatus === 'trial') {
            $normalizedPlan = self::PLAN_TRIAL;
        } else {
            // Only monthly/annual allowed for non-trial
            if (!in_array($normalizedPlan, self::VALID_PLANS, true) || $normalizedPlan === self::PLAN_TRIAL) {
                throw new \InvalidArgumentException('Invalid plan for active subscription: ' . (string)$incomingPlan);
            }
        }

        // Update plan
        $this->plan = $normalizedPlan;

        // ✅ Recalculate status:
        // if fpds_query AND currently within trial window → STATUS_TRIAL
        // else → incoming status or ACTIVE
        if ($this->isFpdsQuerySubscription() && $this->isCurrentlyTrial()) {
            $this->status = self::STATUS_TRIAL;
            $this->plan = self::PLAN_TRIAL; // keep consistent
        } else {
            $this->status = $incomingStatus !== '' ? $incomingStatus : self::STATUS_ACTIVE;
        }

        // ✅ Recalculate dates
        if ($this->status === self::STATUS_TRIAL) {
            // Trial: fixed 7-day duration from "now" (simple + predictable)
            $this->trial_start_at  = $now;
            $this->trial_end_at    = $now->copy()->addDays(7);
            $this->next_billing_at = $now->copy()->addDays(7);
            $this->expires_at      = $now->copy()->addDays(7);
        } else {
            $this->next_billing_at = $this->calculateNextBillingDate();
            $this->expires_at      = $this->calculateExpireDate();
            // trial_* fields keep history; if хочешь обнулять — делай отдельно явным действием
        }

        // Common fields
        $this->cancelled_at = null;

        // ✅ Amount (safe)
        if ($this->status === self::STATUS_TRIAL || $this->plan === self::PLAN_TRIAL) {
            $this->amount = 0.00;
        } else {
            $this->amount = (float)(self::PRICES[$this->subscription_type][$this->plan] ?? 0.00);
        }

        $this->currency = $this->currency ?: 'USD';

        try {
            return (bool)$this->save();
        } catch (\Throwable $e) {
            Log::error('Subscription update failed', [
                'error_message'       => $e->getMessage(),
                'exception_class'     => get_class($e),
                'subscription_id'     => $this->id,
                'user_id'             => $this->user_id,
                'subscription_type'   => $this->subscription_type,
                'plan'                => $this->plan,
                'status'              => $this->status,
            ]);
            throw $e;
        }
    }


}