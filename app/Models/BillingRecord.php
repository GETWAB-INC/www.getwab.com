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
     * @return string Читаемое описание вида:
     *   - «7‑day FPDS Query trial → Annual subscription» (для trial);
     *   - «FPDS Reports → Annual subscription» (для не‑trial).
     */
    protected static function getReadableDescription(array $data): string
    {
        $typeNames = [
            'fpds_query' => 'FPDS Query',
            'fpds_reports' => 'FPDS Reports',
        ];
        $planNames = [
            'Monthly' => 'Monthly',
            'Annual' => 'Annual',
        ];

        $subscriptionType = $data['subscription_type'] ?? '';
        $subscriptionStatus = $data['subscription_status'] ?? '';
        $subscriptionPlan = $data['subscription_plan'] ?? '';

        $typeName = $typeNames[$subscriptionType] ?? $subscriptionType;
        $planName = $planNames[$subscriptionPlan] ?? $subscriptionPlan;

        if ($subscriptionStatus === 'trial') {
            // Для trial: «7‑day [тип] trial → [план] subscription»
            return "7‑day {$typeName} trial → {$planName} subscription";
        } else {
            // Для не‑trial: «[тип] → [план] subscription»
            return "{$typeName} → {$planName} subscription";
        }
    }

    private static function getPackageDescription(array $data): string
    {
        $packageNames = [
            'elementary' => 'Elementary Report Package',
            'composite' => 'Composite Report Package',
        ];

        $packageType = $data['package_type'] ?? '';
        $reportsCount = $data['reports_count'] ?? 0;

        $packageName = $packageNames[$packageType] ?? $packageType;

        return "{$packageName} ({$reportsCount} reports)";
    }



    public static function createRecord(array $data): BillingRecord
    {
        // 1. Определяем тип записи: подписка или пакет
        $isSubscription = isset($data['subscription_type']);
        $isReportPackage = isset($data['package_type']);

        if (!$isSubscription && !$isReportPackage) {
            throw new \InvalidArgumentException('Data must contain either subscription_type or package_type');
        }

        // 2. Формируем читаемое описание
        $description = $isSubscription
            ? self::getSubscriptionDescription($data)
            : self::getPackageDescription($data);

        // 3. Создаём запись
        return self::create([
            'user_id' => auth()->id(),
            'billed_at' => now(),
            'description' => $description,
            'card_last_four' => $data['card_last_four'] ?? '0000',
            'card_brand' => $data['card_brand'] ?? 'Unknown',
            'amount' => $isSubscription ? $data['subscription_price'] : $data['package_price'],
            'currency' => $data['currency'] ?? 'USD',
            'status' => 'completed',
            'gateway_transaction_id' => $data['transaction_id'] ?? null,
        ]);
    }
}
