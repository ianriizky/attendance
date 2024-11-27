<?php

namespace App\Filament\Pages;

use App\Enums\UserRole;

class AdminDashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Admin dashboard';

    public static function canAccess(): bool
    {
        return auth()->guard()->user()->role === UserRole::Admin;
    }

    /**
     * @return array<class-string<\Filament\Widgets\Widget> | \Filament\Widgets\WidgetConfiguration>
     */
    public function getWidgets(): array
    {
        return [
            \Filament\Widgets\AccountWidget::class,
            \Filament\Widgets\FilamentInfoWidget::class,
            \App\Filament\Resources\UserResource\Widgets\StatsOverview::class,
            \App\Filament\Resources\EmployeeResource\Widgets\StatsOverview::class,
        ];
    }
}
