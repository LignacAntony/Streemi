<?php

declare(strict_types=1);


namespace App\Enum;

enum AccountStatusEnum: string
{
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case APPROVE = 'approve';
    case DELETE = 'delete';
    case REJECT = 'reject';
}
