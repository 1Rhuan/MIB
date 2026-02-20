<?php

namespace App\Models;

use App\Enums\ShippingPlatform;
use App\Enums\ShippingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDestinations extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'platform',
        'player_id',
        'status',
    ];

    protected $casts = [
        'status' => ShippingStatus::class,
        'platform' => ShippingPlatform::class,
    ];

    protected $hidden = [
        'id',
        'order_id',
        'created_at',
        'updated_at',
    ];
}
