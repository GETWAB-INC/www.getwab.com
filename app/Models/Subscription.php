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
        'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_at' => 'datetime',
        'next_billing_at' => 'datetime',
        'expires_at' => 'datetime',
        'trial_start_at' => 'datetime',
        'trial_end_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_TRIAL = 'trial';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_SUSPENDED = 'suspended';

    public const VALID_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_TRIAL,
        self::STATUS_CANCELLED,
        self::STATUS_EXPIRED,
        self::STATUS_SUSPENDED,
    ];

    public const PRICES = [
        'fpds_query' => [
            'Monthly' => 49.00,
            'Annual' => 490.00,
        ],
        'fpds_reports' => [
            'Monthly' => 799.00,
            'Annual' => 6490.00,
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
        return !$this->trial_end_at || now() <= $this->trial_end_at;
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

    // ADDED: calculate next billing date
    public function calculateNextBillingDate(): \Carbon\Carbon
    {
        $startsAt = $this->start_at ?? now();

        return match ($this->plan) {
            'Monthly' => $startsAt->addMonth(),
            'Annual'  => $startsAt->addYear(),
            default   => $startsAt->addMonth(), // default: one month
        };
    }

    // ADDED: calculate subscription expiration date
    public function calculateExpireDate(): \Carbon\Carbon
    {
        $startsAt = $this->start_at ?? now();

        return match ($this->plan) {
            'Monthly' => $startsAt->addMonth(),
            'Annual'  => $startsAt->addYear(),
            default   => $startsAt->addMonth(), // default: one month
        };
    }

    public static function store(array $data): Subscription
    {
        $subscription_type   = $data['subscription_type'];
        $subscription_status = $data['subscription_status'];
        $subscription_price  = $data['subscription_price'];
        $subscription_plan   = $data['subscription_plan'];
        $billing_record_id   = $data['billing_record_id'];

        // Look for an existing user subscription of the given type
        $existingSubscription = Subscription::where('user_id', auth()->id())
            ->where('subscription_type', $subscription_type)
            ->first();

        if ($existingSubscription) {
            // Update existing subscription
            $subscription = $existingSubscription;
            $subscription->billing_record_id = $billing_record_id;
            $subscription->status = $subscription_status;
            $subscription->plan = $subscription_plan;
            // Do NOT change start_at — keep the original start date

            if ($subscription_status == 'trial') {
                $subscription->next_billing_at = now()->addDays(7);
                $subscription->expires_at = now()->addDays(7);
                $subscription->trial_start_at = now();
                $subscription->trial_end_at = now()->addDays(7);
            } else {
                $subscription->next_billing_at = $subscription->calculateNextBillingDate();
                $subscription->expires_at = $subscription->calculateExpireDate();
            }

            $subscription->cancelled_at = null;
            $subscription->amount = self::PRICES[$subscription_type][$subscription_plan];
            $subscription->currency = 'USD';
            $subscription->payment_gateway_id = null;
            $subscription->notes = "Subscription updated, linked to billing #{$billing_record_id}";
        } else {
            // Create a new subscription
            $subscription = new Subscription();
            $subscription->user_id = auth()->id();
            $subscription->billing_record_id = $billing_record_id;
            $subscription->subscription_type = $subscription_type;
            $subscription->status = $subscription_status;
            $subscription->plan = $subscription_plan;
            $subscription->start_at = now(); // Only for new subscriptions

            if ($subscription_status == 'trial') {
                $subscription->next_billing_at = now()->addDays(7);
                $subscription->expires_at = now()->addDays(7);
                $subscription->trial_start_at = now();
                $subscription->trial_end_at = now()->addDays(7);
            } else {
                $subscription->next_billing_at = $subscription->calculateNextBillingDate();
                $subscription->expires_at = $subscription->calculateExpireDate();
            }

            $subscription->cancelled_at = null;
            $subscription->amount = self::PRICES[$subscription_type][$subscription_plan];
            $subscription->currency = 'USD';
            $subscription->payment_gateway_id = null;
            $subscription->notes = "Subscription linked to billing #{$billing_record_id}";
        }

        try {
            $subscription->save();
        } catch (\Exception $e) {
            Log::error('Failed to save/update subscription in store', [
                'error_message' => $e->getMessage(),
                'exception_class' => get_class($e),
                'data_used' => $data,
                'user_id' => auth()->id(),
                'subscription_type' => $subscription_type,
                'timestamp' => now()->toDateTimeString()
            ]);
            throw $e;
        }

        return $subscription;
    }

    /**
     * Updates the subscription and recalculates dates and status.
     *
     * @param array $data Data to update: ['plan' => ..., 'status' => ...]
     * @return bool True on success, false on failure
     */
    public function updateSubscription(array $data): bool
    {
        $newPlan = $data['plan'] ?? $this->plan;
        $newStatus = $data['status'] ?? $this->status;

        // Update plan
        $this->plan = $newPlan;

        // Recalculate status: if trial is active AND subscription is fpds_query → STATUS_TRIAL, otherwise STATUS_ACTIVE
        if ($this->isFpdsQuerySubscription() && $this->isCurrentlyTrial()) {
            $this->status = Subscription::STATUS_TRIAL;
        } else {
            $this->status = $newStatus ?? Subscription::STATUS_ACTIVE;
        }

        // Recalculate dates based on plan type (Monthly/Annual)
        if ($this->status === Subscription::STATUS_TRIAL) {
            // Trial has a fixed 7-day duration
            $this->next_billing_at = now()->addDays(7);
            $this->expires_at = now()->addDays(7);
            $this->trial_start_at = now();
            $this->trial_end_at = now()->addDays(7);
        } else {
            // Active subscriptions: calculate dates based on plan (Monthly/Annual)
            $this->next_billing_at = $this->calculateNextBillingDate();
            $this->expires_at = $this->calculateExpireDate();
        }

        // Common fields
        $this->cancelled_at = null;
        $this->updated_at = now();
        $this->amount = self::PRICES[$this->subscription_type][$this->plan];

        try {
            return $this->save();
        } catch (\Exception $e) {
            Log::error('Subscription update failed: ' . $e->getMessage());
            throw $e;
        }
    }

}