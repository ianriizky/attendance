<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PresenceType: string implements HasLabel
{
    case ClockIn = 'clock_in';
    case ClockOut = 'clock_out';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ClockIn => 'Clock In',
            self::ClockOut => 'Clock Out',
        };
    }
}
