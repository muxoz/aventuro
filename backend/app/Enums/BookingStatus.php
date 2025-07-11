<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'Pending';
    case Cancelled = 'Cancelled';
    case Payed = 'Payed';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Cancelled => 'Cancelled',
            self::Payed => 'Payed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'yellow',
            self::Cancelled => 'red',
            self::Payed => 'green',
        };
    }
}
