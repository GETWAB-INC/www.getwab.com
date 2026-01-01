<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingRecord extends Model
{
    use SoftDeletes;

    // Таблица БД
    protected $table = 'billing_records';

    // Поля, доступные для массового присваивания
    protected $fillable = [
        'user_id',
        'billed_at',
        'description',
        'card_last_four',
        'card_brand',
        'amount',
        'currency',
        'status',
        'gateway_transaction_id',
    ];

    // Касты для автоматического преобразования типов
    protected $casts = [
        'amount' => 'decimal:2',
        'billed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Значения по умолчанию
    protected $attributes = [
        'currency' => 'USD',
    ];

    /**
     * Связь с пользователем
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function items()
    {
        return $this->hasMany(BillingRecord::class, 'billing_record_id');
    }

    /**
     * Проверка, завершена ли транзакция
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Проверка, отменена ли транзакция
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Проверка, находится ли транзакция в обработке
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Форматирование суммы для вывода
     */
    public function getFormattedAmount(): string
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }

    /**
     * Получение маскированной карты (например, «Visa •••• 1234»)
     */
    public function getMaskedCard(): string
    {
        return $this->card_brand . ' •••• ' . $this->card_last_four;
    }

    /**
     * Обновление статуса транзакции
     */
    public function updateStatus(string $newStatus): void
    {
        $this->status = $newStatus;
        $this->save();
    }

    /**
     * Отмена транзакции (с обновлением статуса)
     */
    public function cancel(): void
    {
        $this->updateStatus('cancelled');
    }

    /**
     * Подтверждение транзакции (с обновлением статуса)
     */
    public function confirm(): void
    {
        $this->updateStatus('completed');
    }

    public function getFormattedDate(): string
    {
        return $this->billed_at ? $this->billed_at->format('M j, Y') : 'N/A';
    }

    /**
     * Формирует читаемое описание на основе входных данных (без экземпляра модели).
     * Используется при создании записи, чтобы избежать двойного запроса в БД.
     *
     * @param array $data Исходные данные подписки
     * @return string Читаемое описание вида «FPDS Query Trial (Monthly)»
     */
    protected static function getReadableDescription(array $data): string
    {
        $typeNames = [
            'fpds_query' => 'FPDS Query',
            'fpds_reports' => 'FPDS Reports',
        ];
        $statusNames = [
            'trial' => 'Trial',
            'active' => 'Subscription',
        ];
        $planNames = [
            'Monthly' => 'Monthly',
            'Annual' => 'Annual',
        ];

        $subscriptionType = $data['subscription_type'] ?? '';
        $subscriptionStatus = $data['subscription_status'] ?? '';
        $subscriptionPlan = $data['subscription_plan'] ?? '';

        $typeName = $typeNames[$subscriptionType] ?? $subscriptionType;
        $statusName = $statusNames[$subscriptionStatus] ?? $subscriptionStatus;
        $planName = $planNames[$subscriptionPlan] ?? $subscriptionPlan;

        return "{$typeName} {$statusName} ({$planName})";
    }



    public static function createRecord(array $data): BillingRecord
    {
        // 1. Формируем читаемое описание ДО создания записи
        $readableDescription = self::getReadableDescription($data);
        
        // 2. Создаём запись С ГОТОВЫМ description
        return self::create([
            'user_id' => auth()->id(),
            'billed_at' => now(),
            'description' => $readableDescription,
            'card_last_four' => $data['card_last_four'] ?? '0000',
            'card_brand' => $data['card_brand'] ?? 'Unknown',
            'amount' => $data['subscription_price'],
            'currency' => $data['currency'] ?? 'USD',
            'status' => 'completed',
            'gateway_transaction_id' => $data['transaction_id'] ?? null,
            // 'subscription_type' => $data['subscription_type'] ?? '',
            // 'subscription_status' => $data['subscription_status'] ?? '',
            // 'subscription_plan' => $data['subscription_plan'] ?? '',
        ]);
    }
}
