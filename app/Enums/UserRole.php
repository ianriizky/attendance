<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Admin = 'admin';
    case Employee = 'employee';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
