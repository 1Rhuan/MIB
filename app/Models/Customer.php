<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static firstOrCreate(array $array, array $array1)
 * @method static updateOrCreate(array $array, array $array1)
 */
class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'nickname',
        'email',
        'platform',
        'player_id',
    ];
}
