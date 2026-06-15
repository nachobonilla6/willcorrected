<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-home';

    public function getColumns(): int|array
    {
        return 2;
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\AnalyticsOverview::class,
            \App\Filament\Widgets\ContentLineChart::class,
            \App\Filament\Widgets\AmenityBarChart::class,
        ];
    }
}
