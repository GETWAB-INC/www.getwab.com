<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * Проверяет, относится ли подписка к типу 'fpds_query'.
     * @return bool true — подписка типа 'fpds_query', false — иной тип или null
     */
    public function isFpdsQuerySubscription(): bool
    {
        return $this->subscription_type === 'fpds_query';
    }

    /**
     * Проверяет, относится ли подписка к типу 'fpds_reports'.
     * @return bool true — подписка типа 'fpds_reports', false — иной тип или null
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
     * Активация подписки (перевод из trial в active)
     */
    public function activate(): void
    {
        $this->status = self::STATUS_ACTIVE;
        $this->save();
    }

    /**
     * Отмена подписки
     */
    public function cancel(): void
    {
        $this->status = self::STATUS_CANCELLED;
        $this->save();
    }

    /**
     * Приостановка подписки
     */
    public function suspend(): void
    {
        $this->status = self::STATUS_SUSPENDED;
        $this->save();
    }

    /**
     * Пометка подписки как истёкшей
     */
    public function markAsExpired(): void
    {
        $this->status = self::STATUS_EXPIRED;
        $this->save();
    }

    // ДОБАВЛЕНО: расчёт даты следующего биллинга
    public function calculateNextBillingDate(): \Carbon\Carbon
    {
        $startsAt = $this->start_at ?? now();
        return match ($this->plan) {
            'Monthly' => $startsAt->addMonth(),
            'Annual' => $startsAt->addYear(),
            default => $startsAt->addMonth(), // по умолчанию — месяц
        };
    }

    // ДОБАВЛЕНО: расчёт даты истечения подписки
    public function calculateExpireDate(): \Carbon\Carbon
    {
        $startsAt = $this->start_at ?? now();
        return match ($this->plan) {
            'Monthly' => $startsAt->addMonth(),
            'Annual' => $startsAt->addYear(),
            default => $startsAt->addMonth(), // по умолчанию — месяц
        };
    }

    public static function store(array $data): Subscription
    {
        $subscription_type = $data['subscription_type'];
        $subscription_status = $data['subscription_status'];
        $subscription_price = $data['subscription_price'];
        $subscription_plan = $data['subscription_plan'];
        $billing_record_id = $data['billing_record_id'];

        $subscription = new Subscription();
        $subscription->user_id = auth()->id();
        $subscription->billing_record_id = $billing_record_id;
        $subscription->subscription_type = $subscription_type;
        $subscription->status = $subscription_status;
        $subscription->plan = $subscription_plan;
        $subscription->start_at = now();

        if ($subscription_status == 'trial') {
            $subscription->next_billing_at = now()->addDays(7);
            $subscription->expires_at = now()->addDays(7);
            $subscription->trial_start_at = now();
            $subscription->trial_end_at = now()->addDays(7);
        } else {
            $subscription->next_billing_at = $subscription->calculateNextBillingDate();
            $subscription->expires_at = $subscription->calculateExpireDate();
        }

        $subscription->cancelled_at = NULL;
        $subscription->amount = self::PRICES[$subscription_type][$subscription_plan];
        $subscription->currency = 'USD';
        $subscription->payment_gateway_id = NULL;
        $subscription->notes = "Subscription linked to billing #{$billing_record_id}";

        try {
            $subscription->save();
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Failed to save subscription in createFromData', [
                'error_message' => $e->getMessage(),
                'exception_class' => get_class($e),
                'data_used' => $data,
                'timestamp' => now()->toDateTimeString()
            ]);
            throw $e;
        }

        return $subscription;
    }

    /**
     * Обновляет подписку с пересчётом дат и статуса.
     * @param array $data Данные для обновления: ['plan' => ..., 'status' => ...]
     * @return bool Успех/неудача обновления
     */
    public function updateSubscription(array $data): bool
    {
        $newPlan = $data['plan'] ?? $this->plan;
        $newStatus = $data['status'] ?? $this->status;

        // Обновляем план
        $this->plan = $newPlan;

        // Пересчитываем статус: если trial активен И подписка fpds_query → STATUS_TRIAL, иначе STATUS_ACTIVE
        if ($this->isFpdsQuerySubscription() && $this->isCurrentlyTrial()) {
            $this->status = Subscription::STATUS_TRIAL;
        } else {
            $this->status = $newStatus ?? Subscription::STATUS_ACTIVE;
        }

        // Пересчитываем даты с учётом типа плана (Monthly/Annual)
        if ($this->status === Subscription::STATUS_TRIAL) {
            // Для trial — фиксированные 7 дней
            $this->next_billing_at = now()->addDays(7);
            $this->expires_at = now()->addDays(7);
            $this->trial_start_at = now();
            $this->trial_end_at = now()->addDays(7);
        } else {
            // Для активных подписок — расчёт по плану (Monthly/Annual)
            $this->next_billing_at = $this->calculateNextBillingDate();
            $this->expires_at = $this->calculateExpireDate();
        }

        // Общие поля
        $this->cancelled_at = null;
        $this->updated_at = now();
        $this->amount = self::PRICES[$this->subscription_type][$this->plan];

        try {
            return $this->save();
        } catch (\Exception $e) {
            \Log::error('Subscription update failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
