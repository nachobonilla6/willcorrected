<?php

namespace App\Filament\Widgets;

use App\Models\Amenity;
use App\Models\Article;
use App\Models\GalleryImage;
use App\Models\PropertyContent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $content = PropertyContent::first();
        $heroSet = !empty($content?->hero_image) ? 'Yes' : 'No';
        $detailsSet = !empty($content?->details_image) ? 'Yes' : 'No';

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
