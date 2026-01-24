<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $paymentId)
 * @method static where(string $string, int $gatewayPaymentId)
 */
class Payment extends Model
{
    protected $fillable = [
        'gateway_payment_id',
        'status',
        'status_detail',
    ];

    protected $casts = [
        'transaction_amount'  => 'decimal:2',
        'net_received_amount' => 'decimal:2',
        'total_paid_amount'   => 'decimal:2',
        'date_created' => 'datetime',
        'date_last_updated' => 'datetime',
        'date_approved' => 'datetime',
        'date_expiration' => 'datetime',
        'money_release_date' => 'datetime',
        'live_mode'   => 'boolean',
        'status' => PaymentStatus::class,
    ];

    public function isPending(): bool
    {
        return $this->status === PaymentStatus::PENDING;
    }

    public function isApproved(): bool
    {
        return $this->status === PaymentStatus::APPROVED;
    }

    public function isRejected(): bool
    {
        return in_array(
            $this->status,
            [
                PaymentStatus::REJECTED,
                PaymentStatus::CANCELLED,
                PaymentStatus::EXPIRED,
            ],
            true
        );
    }
}
