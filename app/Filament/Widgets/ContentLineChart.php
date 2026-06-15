<?php

namespace App\Filament\Widgets;

use App\Models\Amenity;
use App\Models\Article;
use App\Models\GalleryImage;
use Filament\Widgets\ChartWidget;

class ContentLineChart extends ChartWidget
{
    protected static ?string $heading = 'Content Overview';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Records',
                    'data' => [
                        Amenity::count(),
                        Article::count(),
                        GalleryImage::count(),
                    ],
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#059669',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => ['Amenities', 'Articles', 'Gallery'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getColumnSpan(): int|string|array
    {
        return 1;
    }
}
