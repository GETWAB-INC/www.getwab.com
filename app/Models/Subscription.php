<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Subscription extends Model
{
    use SoftDeletes;

    // Таблица БД
    protected $table = 'subscriptions';

    // Поля, доступные для массового присваивания
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

    // Касты для автоматического преобразования типов
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

    // Статусы подписки (с заглавной буквы)
    public const STATUS_ACTIVE = 'active';
    public const STATUS_TRIAL = 'trial';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_SUSPENDED = 'suspended';

    // Массив всех допустимых статусов
    public const VALID_STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_TRIAL,
        self::STATUS_CANCELLED,
        self::STATUS_EXPIRED,
        self::STATUS_SUSPENDED,
    ];

    // Цены для подписок (ключи — с заглавной буквы: 'Monthly'/'Annual')
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

    // Значения по умолчанию
    protected $attributes = [
        'currency' => 'USD',
        'status' => self::STATUS_TRIAL,
    ];

    /**
     * Связь с пользователем
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Проверка, является ли статус допустимым
     */
    public static function isValidStatus(string $status): bool
    {
        return in_array($status, self::VALID_STATUSES, true);
    }

    /**
     * Нормализует план к формату с заглавной буквы: 'monthly' → 'Monthly', 'annual' → 'Annual'
     */
    public static function normalizePlan($plan): string
    {
        return match (strtolower($plan)) {
            'monthly', 'month' => 'Monthly',
            'annual', 'year', 'yearly' => 'Annual',
            default => throw new \InvalidArgumentException("Unknown plan: $plan"),
        };
    }

    /**
     * Проверяет, истёк ли trial‑период (более 7 дней с момента trial_start_at или created_at)
     * @return bool true — trial истёк, false — trial ещё активен
     */
    public function isTrialExpired(): bool
    {
        if ($this->status !== self::STATUS_TRIAL) {
            return false;
        }

        $trialStart = $this->trial_start_at ?? $this->created_at;
        $trialEndDate = $trialStart->addDays(7);

        return now() > $trialEndDate;
    }

    /**
     * Возвращает дату окончания trial‑периода (trial_start_at + 7 дней или created_at + 7 дней)
     * @return \Carbon\Carbon
     */
    public function getTrialEndDate(): \Carbon\Carbon
    {
        $trialStart = $this->trial_start_at ?? $this->created_at;
        return $trialStart->addDays(7);
    }

    /**
     * Проверка, активна ли подписка (не отменена, не приостановлена, не истекла, trial не истёк)
     */
    public function isActive(): bool
    {
        // Если это trial и он истёк — подписка не активна
        if ($this->status === self::STATUS_TRIAL && $this->isTrialExpired()) {
            return false;
        }

        // Если trial не активирован (нет trial_start_at), но статус trial — считаем неактивной
        if ($this->status === self::STATUS_TRIAL && !$this->trial_start_at) {
            return false;
        }

        return in_array($this->status, [self::STATUS_ACTIVE, self::STATUS_TRIAL], true)
            && !$this->isExpired();
    }

    /**
     * Проверка, является ли подписка активным trial (статус trial и не истёк)
     * @return bool
     */
    public function isActiveTrial(): bool
    {
        return $this->status === self::STATUS_TRIAL
            && $this->trial_start_at
            && !$this->isTrialExpired();
    }

    /**
     * Продление подписки (обновляет next_billing_at)
     */
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

    /**
     * Проверка, истекла ли подписка (дата прошла ИЛИ статус 'expired')
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at < now()
            || $this->status === self::STATUS_EXPIRED;
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
        $subscription->subscription_type = $subscription_type;
        $subscription->status = $subscription_status;
        $subscription->plan = $subscription_plan;
        $subscription->start_at = now();
        $subscription->next_billing_at = $subscription->calculateNextBillingDate();
        $subscription->expires_at = $subscription->calculateExpireDate();
        $subscription->trial_start_at = now();
        $subscription->trial_end_at = $subscription->getTrialEndDate();
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
}
