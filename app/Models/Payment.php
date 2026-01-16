<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ProviderStatus;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'fee',
        'net_amount',
        'payment_method',
        'status',
        'provider',
        'provider_id',
        'provider_status',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'net_amount' => 'decimal:2',

        'payment_method' => PaymentMethod::class,
        'status' => PaymentStatus::class,
        'provider_status' => ProviderStatus::class,

        'expires_at' => 'datetime',
        'paid_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];
}
