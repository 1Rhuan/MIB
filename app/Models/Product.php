<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'benefits',
        'price',
        'discount',
    ];

    protected $casts = [
        'discount' => 'decimal:2',
        'benefits' => 'array',
        'price' => 'decimal:2',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
