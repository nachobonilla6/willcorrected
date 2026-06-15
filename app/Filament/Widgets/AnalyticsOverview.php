<?php

namespace App\Filament\Widgets;

use App\Models\Amenity;
use App\Models\Article;
use App\Models\GalleryImage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Amenities', Amenity::where('is_active', true)->count())
                ->description('Total active amenities')
                ->descriptionIcon('heroicon-o-list-bullet')
                ->color('success'),
            Stat::make('Articles', Article::where('is_active', true)->count())
                ->description('Total active articles')
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('info'),
            Stat::make('Gallery Photos', GalleryImage::where('is_active', true)->count())
                ->description('Active gallery images')
                ->descriptionIcon('heroicon-o-photo')
                ->color('warning'),
        ];
    }
}
