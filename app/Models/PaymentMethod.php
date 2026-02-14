<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    protected $table = 'payment_methods';

    protected $fillable = [
        'user_id',
        'provider',
        'token',
        'customer_id',
        'payment_instrument_id',
        'instrument_identifier_id',
        'payment_account_reference',
        'request_token',
        'meta',
        'verified_at',
        'last_four',
        'brand',
        'exp_month',
        'exp_year',
        'is_default',
        'is_active',
    ];

    protected $casts = [
        'meta' => 'array',
        'verified_at' => 'datetime',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get default payment method for a user (by provider).
     *
     * Rules:
     * 1) is_active=1 AND is_default=1 AND payment_instrument_id not null
     * 2) fallback: last active tokenized method (verified/updated most recent)
     * 3) if none: throw clear error
     */
    public static function getDefaultForUser(int $userId, string $provider = 'boa'): self
    {
        $provider = strtolower(trim($provider));

        $base = self::query()
            ->where('user_id', $userId)
            ->where('provider', $provider)
            ->where('is_active', 1)
            ->whereNotNull('payment_instrument_id')
            ->where('payment_instrument_id', '!=', '');

        // 1) Active + Default
        $method = (clone $base)
            ->where('is_default', 1)
            ->orderByDesc('verified_at')
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        if ($method) {
            return $method;
        }

        // 2) Fallback: last active
        $method = (clone $base)
            ->orderByDesc('verified_at')
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        if ($method) {
            return $method;
        }

        // 3) No active methods
        throw new \RuntimeException("no active payment method (user_id={$userId}, provider={$provider})");
    }
}
