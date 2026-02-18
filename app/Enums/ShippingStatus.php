<?php

namespace App\Enums;

enum ShippingStatus : string
{
    case PENDING = 'pending';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
