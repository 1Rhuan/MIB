<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static firstOrCreate(array $array, array $array1)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
