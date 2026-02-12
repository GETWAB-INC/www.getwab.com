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
}
