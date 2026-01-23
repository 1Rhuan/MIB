<?php

namespace App\Payments\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'mp_id',
        'date_created',
        'date_approved',
        'date_expiration',
        'external_reference',
        'description',
        'status',
        'status_detail',
        'payment_method',
        'payment_type',
        'transaction_amount',
        'net_received_amount',
        'total_paid_amount',
        'currency',
        'description',
        'payer_id',
        'collector_id',
        'qr_code',
        'ticket_url',
        'live_mode',
    ];

    protected $casts = [
        'transaction_amount'  => 'decimal:2',
        'net_received_amount' => 'decimal:2',
        'total_paid_amount'   => 'decimal:2',
        'date_created'    => 'datetime',
        'date_approved'   => 'datetime',
        'date_expiration' => 'datetime',
        'live_mode'   => 'boolean',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'external_reference', 'id');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return in_array($this->status, ['rejected', 'cancelled', 'expired'], true);
    }
}
