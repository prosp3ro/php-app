<?php

declare(strict_types=1);

namespace App\Enums;

enum EmailStatus: int
{
    case QUEUE = 1;
    case SENT = 2;
    case FAILED = 3;

    public function toString(): string
    {
        return match ($this) {
            self::QUEUE => 'Queue',
            self::SENT => 'Sent',
            self::FAILED => 'Failed'
        };
    }
}
