<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\OrderBy;
use Google\Analytics\Data\V1beta\OrderBy\MetricOrderBy;

class AmenityBarChart extends ChartWidget
{
    protected static ?string $heading = 'Top Pages (30 days)';

    protected static ?string $pollingInterval = '10m';

    protected function getData(): array
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
                'dimensions' => [
                    new Dimension(['name' => 'pagePath']),
                ],
                'metrics' => [
                    new Metric(['name' => 'screenPageViews']),
                ],
                'limit' => 5,
                'orderBys' => [
                    new OrderBy([
                        'metric' => new MetricOrderBy([
                            'metric_name' => 'screenPageViews',
                        ]),
                        'desc' => true,
                    ]),
                ],
            ]);

            $labels = [];
            $data = [];

            foreach ($response->getRows() as $row) {
                $path = $row->getDimensionValues()[0]->getValue();
                $labels[] = mb_strlen($path) > 25 ? '...' . mb_substr($path, -22) : $path;
                $data[] = (int) $row->getMetricValues()[0]->getValue();
            }

            if (empty($labels)) {
                $labels = ['No data yet'];
                $data = [0];
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Page Views',
                        'data' => $data,
                        'backgroundColor' => '#f59e0b',
                        'borderColor' => '#d97706',
                        'barThickness' => 32,
                    ],
                ],
                'labels' => $labels,
            ];
        } catch (\Exception $e) {
            return [
                'datasets' => [
                    [
                        'label' => 'Error',
                        'data' => [0],
                        'backgroundColor' => '#ef4444',
                        'barThickness' => 32,
                    ],
                ],
                'labels' => ['API Error'],
            ];
        }
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
