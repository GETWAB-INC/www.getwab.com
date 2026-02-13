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
     * 1) is_active=1 AND is_default=1
     * 2) fallback: last active (most recently verified/updated)
     * 3) if none: throw clear error "no active payment method"
     */
    public static function getDefaultForUser(int $userId, string $provider = 'boa'): self
    {
        $provider = strtolower(trim($provider));

        // 1) Active + Default
        $method = self::query()
            ->where('user_id', $userId)
            ->where('provider', $provider)
            ->where('is_active', 1)
            ->where('is_default', 1)
            ->orderByDesc('verified_at')   // prefer verified cards if there are multiple defaults (bad data)
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        if ($method) {
            return $method;
        }

        // 2) Fallback: last active
        $method = self::query()
            ->where('user_id', $userId)
            ->where('provider', $provider)
            ->where('is_active', 1)
            ->orderByRaw('verified_at IS NULL') // verified first (NULL goes last)
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
