<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first business info ID
        $businessInfo = \App\Models\BusinessInfo::first();
        if (!$businessInfo) {
            $this->command->error('No business info found. Please run BusinessInfoSeeder first.');
            return;
        }

        $operatingHours = [
            [
                'day_of_week' => 'monday',
                'opening_time' => '10:00',
                'closing_time' => '22:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => null,
            ],
            [
                'day_of_week' => 'tuesday',
                'opening_time' => '10:00',
                'closing_time' => '22:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => null,
            ],
            [
                'day_of_week' => 'wednesday',
                'opening_time' => '10:00',
                'closing_time' => '22:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => null,
            ],
            [
                'day_of_week' => 'thursday',
                'opening_time' => '10:00',
                'closing_time' => '22:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => null,
            ],
            [
                'day_of_week' => 'friday',
                'opening_time' => '10:00',
                'closing_time' => '23:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => 'Extended hours on Friday',
            ],
            [
                'day_of_week' => 'saturday',
                'opening_time' => '09:00',
                'closing_time' => '23:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => 'Weekend hours',
            ],
            [
                'day_of_week' => 'sunday',
                'opening_time' => '09:00',
                'closing_time' => '22:00',
                'is_closed' => false,
                'is_24_hours' => false,
                'notes' => 'Weekend hours',
            ],
        ];

        foreach ($operatingHours as $hour) {
            $hour['business_info_id'] = $businessInfo->id;
            \App\Models\OperatingHour::create($hour);
        }
    }
}
