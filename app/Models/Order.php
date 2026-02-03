<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @method static create(array $array)
 */
class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'total_amount',
    ];

    protected $hidden = [
        'id',
        'customer_id',
        'created_at',
        'updated_at',
    ];

    protected $attributes = [
        'status' => OrderStatus::PENDING,
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'status' => OrderStatus::class,
    ];

    protected static function booted()
    {
        static::creating(function (Order $order) {
            if (empty($order->reference)) {
                $order->reference = (string) Str::ulid();
            }
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderTarget(): HasOne
    {
        return $this->hasOne(OrderTarget::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
