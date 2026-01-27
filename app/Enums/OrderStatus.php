<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = "Pending";
    case PROCESSING = "Processing";
    case PAID = "Paid";
    case COMPLETED = "Completed";
    case CANCELLED = "Cancelled";
}
