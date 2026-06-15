<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;

class AnalyticsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10m';

    protected function getStats(): array
    {
        try {
            $client = new BetaAnalyticsDataClient([
                'credentials' => storage_path('app/analytics/clave-will.json'),
            ]);

            $propertyId = '15074266725';

            $response = $client->runReport([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    new DateRange(['start_date' => '30daysAgo', 'end_date' => 'today']),
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                    new Metric(['name' => 'sessions']),
                    new Metric(['name' => 'screenPageViews']),
                ],
            ]);

            $row = $response->getRows()[0];
            $users = $row ? $row->getMetricValues()[0]->getValue() : 0;
            $sessions = $row ? $row->getMetricValues()[1]->getValue() : 0;
            $pageviews = $row ? $row->getMetricValues()[2]->getValue() : 0;

            return [
                Stat::make('Active Users (30d)', $users)
                    ->description('Users in last 30 days')
                    ->descriptionIcon('heroicon-o-users')
                    ->color('success'),
                Stat::make('Sessions (30d)', $sessions)
                    ->description('Total sessions')
                    ->descriptionIcon('heroicon-o-arrow-trending-up')
                    ->color('info'),
                Stat::make('Page Views (30d)', $pageviews)
                    ->description('Total page views')
                    ->descriptionIcon('heroicon-o-eye')
                    ->color('warning'),
            ];
        } catch (\Exception $e) {
            return [
                Stat::make('Google Analytics', 'Error')
                    ->description($e->getMessage())
                    ->color('danger'),
            ];
        }
    }
}
