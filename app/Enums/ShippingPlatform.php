<?php

namespace App\Enums;

enum ShippingPlatform: string
{
    case STEAM = 'steam';
    case XBOX = 'xbox';
    case EPICGAMES = 'epic_games';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
