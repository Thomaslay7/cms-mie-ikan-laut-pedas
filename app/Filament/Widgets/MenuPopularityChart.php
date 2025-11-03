<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class MenuPopularityChart extends ChartWidget
{
    protected ?string $heading = 'Menu Popularity Chart';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Simulate menu popularity data
        $categories = \App\Models\Category::with('menuItems')->get();

        $data = [];
        $labels = [];
        $values = [];

        foreach ($categories as $category) {
            $labels[] = $category->name;
            // Simulate popularity with random data for demo
            $values[] = rand(10, 100);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Menu Items per Category',
                    'data' => $values,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'borderColor' => 'rgba(245, 158, 11, 1)',
                    'pointBackgroundColor' => 'rgba(245, 158, 11, 1)',
                    'pointBorderColor' => '#fff',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(245, 158, 11, 1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
