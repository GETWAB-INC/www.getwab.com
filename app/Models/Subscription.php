<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
        'expires_at',
        'trial_start_at',
        'trial_end_at',
    ];
}
