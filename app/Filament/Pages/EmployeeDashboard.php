<?php

namespace App\Filament\Pages;

use App\Enums\UserRole;

class EmployeeDashboard extends \Filament\Pages\Dashboard
{
    protected static string $routePath = 'dashboard-employee';

    protected static ?string $title = 'Employee dashboard';

    public static function canAccess(): bool
    {
        return auth()->guard()->user()->role === UserRole::Employee;
    }

    /**
     * @return array<class-string<\Filament\Widgets\Widget> | \Filament\Widgets\WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            \Filament\Widgets\AccountWidget::class,
        ];
    }
}
