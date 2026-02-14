<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class BillingRecord extends Model
{
    use SoftDeletes;

    // Database table
    protected $table = 'billing_records';

    /**
     * Canonical dictionary (per billing canon / docs)
     * billing_records.status MUST be one of:
     *   Paid | Pending | Declined | Failed
     *
     * NOTE: We keep backward-compat reads for legacy lowercase values:
     *   completed -> Paid
     *   pending   -> Pending
     *   cancelled -> Declined
     */
    public const STATUS_PAID     = 'Paid';
    public const STATUS_PENDING  = 'Pending';
    public const STATUS_DECLINED = 'Declined';
    public const STATUS_FAILED   = 'Failed';

    // Fields available for mass assignment
    protected $fillable = [
        'user_id',
        'billed_at',
        'description',
        'reference_number',
        'flow',
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

    /**
     * Normalize legacy statuses -> canonical.
     */
    public static function normalizeStatus(?string $status): string
    {
        $s = trim((string)$status);

        if ($s === '') {
            return self::STATUS_PAID;
        }

        // Canonical pass-through
        if (in_array($s, [self::STATUS_PAID, self::STATUS_PENDING, self::STATUS_DECLINED, self::STATUS_FAILED], true)) {
            return $s;
        }

        // Legacy mappings (do NOT write these going forward)
        $lower = strtolower($s);
        return match ($lower) {
            'completed' => self::STATUS_PAID,
            'pending'   => self::STATUS_PENDING,
            'cancelled' => self::STATUS_DECLINED,
            'canceled'  => self::STATUS_DECLINED,
            'declined'  => self::STATUS_DECLINED,
            'failed'    => self::STATUS_FAILED,
            default     => self::STATUS_FAILED,
        };
    }

    /**
     * Checking if the transaction is complete.
     */
    public function isCompleted(): bool
    {
        return self::normalizeStatus($this->status) === self::STATUS_PAID;
    }

    /**
     * Checking if a transaction is canceled
     */
    public function isCancelled(): bool
    {
        return self::normalizeStatus($this->status) === self::STATUS_DECLINED;
    }

    /**
     * Checking if the transaction is being processed.
     */
    public function isPending(): bool
    {
        return self::normalizeStatus($this->status) === self::STATUS_PENDING;
    }

    /**
     * Formatting the amount for display.
     */
    public function getFormattedAmount(): string
    {
        return number_format((float)$this->amount, 2) . ' ' . $this->currency;
    }

    /**
     * Obtaining a masked card number (for example, "Visa •••• 1234")
     */
    public function getMaskedCard(): string
    {
        $brand = $this->card_brand ?: 'Unknown';
        $last4 = $this->card_last_four ?: '----';
        return $brand . ' •••• ' . $last4;
    }

    /**
     * Transaction status update (canonical)
     */
    public function updateStatus(string $newStatus): void
    {
        $this->status = self::normalizeStatus($newStatus);
        $this->save();
    }

    /**
     * Transaction cancellation (with status update)
     */
    public function cancel(): void
    {
        $this->updateStatus(self::STATUS_DECLINED);
    }

    /**
     * Transaction confirmation (with status update)
     */
    public function confirm(): void
    {
        $this->updateStatus(self::STATUS_PAID);
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
            'Annual'  => 'Annual',
            'monthly' => 'Monthly',
            'annual'  => 'Annual',
            'trial'   => 'Trial',
        ];

        $subscriptionType = $data['subscription_type'] ?? '';
        $subscriptionStatus = $data['subscription_status'] ?? '';
        $subscriptionPlan = $data['subscription_plan'] ?? '';

        $typeName = $typeNames[$subscriptionType] ?? $subscriptionType;
        $planName = $planNames[$subscriptionPlan] ?? $subscriptionPlan;

        if ($subscriptionStatus === 'trial') {
            return "7-day {$typeName} trial → {$planName} subscription";
        }

        return "{$typeName} → {$planName} subscription";
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

    /**
     * Canonical: billing_records idempotency is (user_id, flow, reference_number).
     * We still store gateway_transaction_id for traceability, but it is not the ledger key.
     */
    public static function createRecord(array $data): BillingRecord
    {
        // ---------------------------------------------------------------------
        // Required: billing record must always belong to a user
        // ---------------------------------------------------------------------
        $userId = $data['user_id'] ?? null;
        if (!$userId) {
            Log::channel('billing')->error('BillingRecord: missing user_id', [
                'transaction_id' => $data['transaction_id'] ?? null,
            ]);
            throw new \InvalidArgumentException('Missing user_id for BillingRecord');
        }

        // ---------------------------------------------------------------------
        // Determine billing type (subscription or package)
        // ---------------------------------------------------------------------
        $isSubscription  = array_key_exists('subscription_type', $data);
        $isReportPackage = array_key_exists('package_type', $data);

        if (!$isSubscription && !$isReportPackage) {
            Log::channel('billing')->error('BillingRecord: invalid payload (no type flags)', [
                'user_id' => $userId,
                'transaction_id' => $data['transaction_id'] ?? null,
            ]);
            throw new \InvalidArgumentException('Data must contain either subscription_type or package_type');
        }

        // ---------------------------------------------------------------------
        // Canonical flow (token_create | pay | renew)
        // - In checkout flows, this is typically: token_create (trial tokenization) or pay (one-time / initial purchase)
        // - Renew should set flow=renew from renew job (not from here)
        // ---------------------------------------------------------------------
        $flow = (string)($data['flow'] ?? '');
        if ($flow === '') {
            Log::channel('billing')->error('BillingRecord: missing flow (must be explicit)', [
                'user_id' => $userId,
                'transaction_id' => $data['transaction_id'] ?? null,
                'reference_number' => $data['reference_number'] ?? null,
            ]);
            throw new \InvalidArgumentException('Missing flow for BillingRecord (must be token_create|pay|renew)');
        }

        $allowed = ['token_create', 'pay', 'renew'];
        if (!in_array($flow, $allowed, true)) {
            Log::channel('billing')->error('BillingRecord: invalid flow', [
                'user_id' => $userId,
                'flow' => $flow,
                'transaction_id' => $data['transaction_id'] ?? null,
                'reference_number' => $data['reference_number'] ?? null,
            ]);
            throw new \InvalidArgumentException("Invalid flow '{$flow}' for BillingRecord");
        }


        // ---------------------------------------------------------------------
        // Canonical reference_number (ledger cycle key)
        // MUST be stable for the given business operation.
        // If not provided, we generate a deterministic-enough fallback to avoid breaking.
        // ---------------------------------------------------------------------
        $referenceNumber = (string)($data['reference_number'] ?? '');
        if ($referenceNumber === '') {
            Log::channel('billing')->error('BillingRecord: missing reference_number (must be explicit)', [
                'user_id' => $userId,
                'flow' => $flow,
                'transaction_id' => $data['transaction_id'] ?? null,
            ]);
            throw new \InvalidArgumentException('Missing reference_number for BillingRecord (must be explicit and stable)');
        }


        // ---------------------------------------------------------------------
        // Build human-readable description
        // ---------------------------------------------------------------------
        $description = $isSubscription
            ? self::getSubscriptionDescription($data)
            : self::getPackageDescription($data);

        // ---------------------------------------------------------------------
        // Amount + status (canonical)
        // createRecord() is called on finalized/accepted flows -> default Paid.
        // Caller may override by passing 'status' (e.g., Pending) if needed.
        // ---------------------------------------------------------------------
        $amount = $isSubscription
            ? ($data['subscription_price'] ?? 0)
            : ($data['package_price'] ?? 0);

        $status = self::normalizeStatus($data['status'] ?? self::STATUS_PAID);

        // ---------------------------------------------------------------------
        // Gateway transaction id for traceability (not the ledger key)
        // ---------------------------------------------------------------------
        $gatewayTx = trim((string)($data['transaction_id'] ?? ''));
        $gatewayTx = $gatewayTx !== '' ? $gatewayTx : null;

        // ---------------------------------------------------------------------
        // Idempotent upsert by (user_id, flow, reference_number)
        // ---------------------------------------------------------------------
        try {
            $record = self::updateOrCreate(
                [
                    'user_id' => $userId,
                    'flow' => $flow,
                    'reference_number' => $referenceNumber,
                ],
                [
                    'billed_at'              => $data['billed_at'] ?? now(),
                    'description'            => $description,
                    'card_last_four'         => ($data['card_last_four'] ?? null) ?: '----',
                    'card_brand'             => ($data['card_brand'] ?? null) ?: 'Unknown',
                    'amount'                 => $amount,
                    'currency'               => $data['currency'] ?? 'USD',
                    'status'                 => $status,
                    'gateway_transaction_id' => $gatewayTx,
                ]
            );

            Log::channel('billing')->info('BillingRecord: upserted', [
                'billing_record_id' => $record->id,
                'user_id' => $userId,
                'flow' => $flow,
                'reference_number' => $referenceNumber,
                'transaction_id' => $gatewayTx,
                'amount' => (string)$record->amount,
                'currency' => $record->currency,
                'status' => $record->status,
                'type' => $isSubscription ? 'subscription' : 'package',
            ]);

            return $record;

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = (int)($e->errorInfo[1] ?? 0);

            Log::channel('billing')->error('BillingRecord: DB error during upsert', [
                'user_id' => $userId,
                'flow' => $flow,
                'reference_number' => $referenceNumber,
                'transaction_id' => $gatewayTx,
                'db_error_code' => $errorCode,
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
