<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case PROCESSING = 'processing';
    case CANCELLED = 'cancelled';
}
