<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Order extends Model
{
    protected $fillable = [
        'reference',
        'customer_id',
        'status',
        'total_amount',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'status' => OrderStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
