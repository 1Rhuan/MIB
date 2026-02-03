<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTarget extends Model
{
    protected $fillable = [
        'order_id',
        'platform',
        'player_id',
        'nickname',
    ];

    protected $hidden = [
        'id',
        'order_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
