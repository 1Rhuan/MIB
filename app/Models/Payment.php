<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $paymentId)
 * @method static where(string $string, int $gatewayPaymentId)
 */
class Payment extends Model
{
    protected $fillable = [
        'payment_id',
        'order_id',
        'status',
        'status_detail',
        'date_created',
        'date_last_updated',
        'date_approved',
        'date_expiration',
        'money_release_date',
        'transaction_amount',
        'transaction_amount_refunded',
        'taxes_amount',
        'net_received_amount',
        'total_paid_amount',
        'fee_type',
        'fee_amount',
        'currency_id',
        'counter_currency',
        'description',
        'payment_method_id',
        'payment_type_id',
        'payment_method_reference_id',
        'authorization_code',
        'operation_type',
        'money_release_status',
        'money_release_schema',
        'issuer_id',
        'collector_id',
        'external_reference',
        'external_resource_url',
        'statement_descriptor',
        'qr_code_base64',
        'qr_code',
        'ticket_url',
        'live_mode',
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
