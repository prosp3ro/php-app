<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: int
{
    case PAID = 1;
    case VOID = 2;
    case DECLINED = 3;
    case PENDING = 4;

    public function toString(): string
    {
        return match ($this) {
            self::PAID => 'Paid',
            self::VOID => 'Void',
            self::DECLINED => 'Declined',
            default => 'Pending'
        };
    }
}
