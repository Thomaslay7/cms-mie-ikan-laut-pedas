<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\StoreSchedule;

class StoreOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $todaySchedule = StoreSchedule::getTodaySchedule();
        $isOpen = $todaySchedule ? $todaySchedule->isCurrentlyOpen() : false;

        return [
            Stat::make('Status Toko', $isOpen ? 'BUKA' : 'TUTUP')
                ->description($todaySchedule ? $todaySchedule->formatted_hours : 'Tidak ada jadwal')
                ->descriptionIcon($isOpen ? 'heroicon-m-check-circle' : 'heroicon-m-x-circle')
                ->color($isOpen ? 'success' : 'danger'),

            Stat::make('Total Menu', MenuItem::count())
                ->description('Item menu tersedia')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('primary'),

            Stat::make('Kategori Menu', Category::count())
                ->description('Kategori makanan')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),

            Stat::make('Testimoni', Testimonial::where('is_featured', true)->count())
                ->description('Testimoni unggulan')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
