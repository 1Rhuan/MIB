<?php

namespace App\Enums;

enum OrderStatus : string
{
    case PENDING = 'pending';
    case WAITING_PAYMENT = 'waiting_payment';
    case PAID = 'paid';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
