<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Menu Items', \App\Models\MenuItem::count())
                ->description('Menu yang tersedia')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Categories', \App\Models\Category::count())
                ->description('Kategori menu')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('info'),

            Stat::make('Gallery Photos', \App\Models\Gallery::count())
                ->description('Foto galeri')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),

            Stat::make('Testimonials', \App\Models\Testimonial::count())
                ->description('Testimoni pelanggan')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
