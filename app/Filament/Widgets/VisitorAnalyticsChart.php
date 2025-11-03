<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class VisitorAnalyticsChart extends ChartWidget
{
    protected ?string $heading = 'Traffic Sources';

    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Traffic Sources',
                    'data' => [45, 25, 15, 10, 5],
                    'backgroundColor' => [
                        'rgb(245, 158, 11)',
                        'rgb(217, 119, 6)',
                        'rgb(180, 83, 9)',
                        'rgb(146, 64, 14)',
                        'rgb(120, 53, 15)',
                    ],
                ],
            ],
            'labels' => ['Direct', 'Google', 'Social Media', 'Email', 'Others'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
