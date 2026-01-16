<?php

namespace App\Enums;

enum ProviderStatus: string
{
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
}
