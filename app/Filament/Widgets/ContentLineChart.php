<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\Dimension;

class ContentLineChart extends ChartWidget
{
    protected static ?string $heading = 'Daily Active Users (30 days)';

    protected static ?string $pollingInterval = '10m';

    protected function getData(): array
    {
        try {
            $client = new BetaAnalyticsDataClient([
                'credentials' => storage_path('app/analytics/clave-will.json'),
            ]);

            $propertyId = '15074214139';

            $response = $client->runReport([
                'property' => "properties/{$propertyId}",
                'dateRanges' => [
                    new DateRange(['start_date' => '30daysAgo', 'end_date' => 'today']),
                ],
                'dimensions' => [
                    new Dimension(['name' => 'date']),
                ],
                'metrics' => [
                    new Metric(['name' => 'activeUsers']),
                ],
                'orderBys' => [
                    new \Google\Analytics\Data\V1beta\OrderBy([
                        'dimension' => new \Google\Analytics\Data\V1beta\OrderBy\DimensionOrderBy([
                            'dimension_name' => 'date',
                        ]),
                    ]),
                ],
            ]);

            $labels = [];
            $data = [];

            foreach ($response->getRows() as $row) {
                $labels[] = \Carbon\Carbon::createFromFormat('Ymd', $row->getDimensionValues()[0]->getValue())->format('M d');
                $data[] = (int) $row->getMetricValues()[0]->getValue();
            }

            return [
                'datasets' => [
                    [
                        'label' => 'Active Users',
                        'data' => $data,
                        'backgroundColor' => '#10b981',
                        'borderColor' => '#059669',
                        'fill' => true,
                        'tension' => 0.3,
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
                    ],
                ],
                'labels' => ['API Error: ' . $e->getMessage()],
            ];
        }
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getColumnSpan(): int|string|array
    {
        return 1;
    }
}
