<?php

namespace App\Enums;

enum ShippingPlatform : string
{
    case STEAM = 'steam';
    case EPICGAMES = 'epic_games';
    case XBOX = 'xbox';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
