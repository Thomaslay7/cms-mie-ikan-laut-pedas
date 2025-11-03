<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            [
                'name' => 'Hari Raya Nyepi',
                'date' => '2025-03-29',
                'is_recurring' => true,
                'recurrence_type' => 'yearly',
                'description' => 'Toko tutup untuk perayaan Hari Raya Nyepi',
                'is_closed' => true,
                'special_opening_time' => null,
                'special_closing_time' => null,
            ],
            [
                'name' => 'Hari Raya Idul Fitri (Hari Pertama)',
                'date' => '2025-03-30',
                'is_recurring' => false,
                'recurrence_type' => null,
                'description' => 'Toko tutup untuk perayaan Idul Fitri',
                'is_closed' => true,
                'special_opening_time' => null,
                'special_closing_time' => null,
            ],
            [
                'name' => 'Hari Raya Idul Fitri (Hari Kedua)',
                'date' => '2025-03-31',
                'is_recurring' => false,
                'recurrence_type' => null,
                'description' => 'Toko tutup untuk perayaan Idul Fitri',
                'is_closed' => true,
                'special_opening_time' => null,
                'special_closing_time' => null,
            ],
            [
                'name' => 'Tahun Baru',
                'date' => '2025-01-01',
                'is_recurring' => true,
                'recurrence_type' => 'yearly',
                'description' => 'Buka dengan jam khusus untuk perayaan Tahun Baru',
                'is_closed' => false,
                'special_opening_time' => '12:00',
                'special_closing_time' => '20:00',
            ],
            [
                'name' => 'Hari Kemerdekaan RI',
                'date' => '2025-08-17',
                'is_recurring' => true,
                'recurrence_type' => 'yearly',
                'description' => 'Buka dengan jam khusus untuk HUT RI',
                'is_closed' => false,
                'special_opening_time' => '11:00',
                'special_closing_time' => '21:00',
            ],
        ];

        foreach ($holidays as $holiday) {
            \App\Models\HolidaySetting::create($holiday);
        }

        echo "Holiday settings seeded successfully!\n";
    }
}
