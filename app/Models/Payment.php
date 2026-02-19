<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static find(int $paymentId)
 * @method static where(string $string, int $gatewayPaymentId)
 */
class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_payment_id',
        'order_id',
        'external_reference',
        'status',
        'status_detail',
        'transaction_amount',
        'fee_amount',
        'payment_method',
        'qr_code_base64',
        'qr_code',
        'date_created',
        'date_approved',
        'date_expiration',
    ];

    protected $casts = [
        'transaction_amount' => 'decimal:2',
        'fee_amount' => 'decimal:2',
        'date_created' => 'datetime',
        'date_approved' => 'datetime',
        'date_expiration' => 'datetime',
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
