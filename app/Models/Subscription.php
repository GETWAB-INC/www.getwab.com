<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'starts_at',
        'next_billing_at',
        'expires_at',
        'amount',
        'currency',
        'payment_gateway_id',
        'notes',
    ];

    // Касты для автоматического преобразования типов
    protected $casts = [
        'amount' => 'decimal:2',
        'starts_at' => 'datetime',
        'next_billing_at' => 'datetime',
        'expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Значения по умолчанию
    protected $attributes = [
        'currency' => 'USD',
        'status' => 'trial',
    ];

    /**
     * Связь с пользователем
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Проверка, активна ли подписка
     */
    public function isActive(): bool
    {
        return $this->status === 'active' &&
               ($this->expires_at === null || $this->expires_at > now());
    }

    /**
     * Расчёт даты следующего списания
     */
    public function calculateNextBillingDate(): \Carbon\Carbon
    {
        $now = now();
        switch ($this->plan) {
            case 'Monthly':
                return $now->addMonth();
            case 'Yearly':
                return $now->addYear();
            default:
                return $now->addMonth();
        }
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
     * Отмена подписки
     */
    public function cancel(): void
    {
        $this->status = 'cancelled';
        $this->save();
    }

    /**
     * Проверка, истекла ли подписка
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at < now();
    }
}
