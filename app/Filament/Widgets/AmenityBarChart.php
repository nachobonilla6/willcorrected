<?php

namespace App\Filament\Widgets;

use App\Models\Amenity;
use Filament\Widgets\ChartWidget;

class AmenityBarChart extends ChartWidget
{
    protected static ?string $heading = 'Amenities Status';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $active = Amenity::where('is_active', true)->count();
        $inactive = Amenity::where('is_active', false)->count();

        return [
            'datasets' => [
                [
                    'label' => 'Amenities',
                    'data' => [$active, $inactive],
                    'backgroundColor' => ['#10b981', '#ef4444'],
                    'borderColor' => ['#059669', '#dc2626'],
                    'barThickness' => 32,
                ],
            ],
            'labels' => ['Active', 'Inactive'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public function getColumnSpan(): int|string|array
    {
        return 1;
    }
}
