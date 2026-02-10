<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingRecord extends Model
{
    use SoftDeletes;

    // Database table
    protected $table = 'billing_records';

    // Fields available for mass assignment
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

    // Casts for automatic type conversion
    protected $casts = [
        'amount' => 'decimal:2',
        'billed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Default values
    protected $attributes = [
        'currency' => 'USD',
    ];

    /**
     * Communication with the user
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
     * Checking if the transaction is complete.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Checking if a transaction is canceled
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Checking if the transaction is being processed.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Formatting the amount for display.
     */
    public function getFormattedAmount(): string
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }

    /**
     * Obtaining a masked card number (for example, "Visa •••• 1234")
     */
    public function getMaskedCard(): string
    {
        return $this->card_brand . ' •••• ' . $this->card_last_four;
    }

    /**
     * Transaction status update
     */
    public function updateStatus(string $newStatus): void
    {
        $this->status = $newStatus;
        $this->save();
    }

    /**
     * Transaction cancellation (with status update)
     */
    public function cancel(): void
    {
        $this->updateStatus('cancelled');
    }

    /**
     * Transaction confirmation (with status update)
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
    * Generates a human-readable description based on the input data (without a model instance). 
    * Used when creating a record to avoid a double database query. 
    *
    * @param array $data The original subscription data
    * @return string A human-readable description of the form:
    *   - "7-day FPDS Query trial → Annual subscription" (for trial); 
    *   - "FPDS Reports → Annual subscription" (for non-trial). 
    */
    protected static function getSubscriptionDescription(array $data): string
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
            // For trial: “7‑day [type] trial → [plan] subscription”
            return "7‑day {$typeName} trial → {$planName} subscription";
        } else {
            // For non-trial: "[type] → [plan] subscription"
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
        $isSubscription = isset($data['subscription_type']);
        $isReportPackage = isset($data['package_type']);

        if (!$isSubscription && !$isReportPackage) {
            throw new \InvalidArgumentException('Data must contain either subscription_type or package_type');
        }

        $userId = $data['user_id'] ?? null;
        if (!$userId) {
            throw new \InvalidArgumentException('Missing user_id for BillingRecord');
        }

        $description = $isSubscription
            ? self::getSubscriptionDescription($data)
            : self::getPackageDescription($data);

        return self::create([
            'user_id' => $userId,
            'billed_at' => now(),
            'description' => $description,
            'card_last_four' => $data['card_last_four'] ?? '0000',
            'card_brand' => $data['card_brand'] ?? 'Unknown',
            'amount' => $isSubscription ? ($data['subscription_price'] ?? 0) : ($data['package_price'] ?? 0),
            'currency' => $data['currency'] ?? 'USD',
            'status' => 'completed',
            'gateway_transaction_id' => $data['transaction_id'] ?? null,
        ]);
    }

}