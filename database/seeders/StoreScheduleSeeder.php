<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'day_of_week' => 'monday',
                'day_name_id' => 'Senin',
                'opening_time' => '09:00:00',
                'closing_time' => '21:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '13:00', 'end' => '14:00', 'note' => 'Istirahat siang']
                ],
                'notes' => 'Jam operasional normal hari Senin',
            ],
            [
                'day_of_week' => 'tuesday',
                'day_name_id' => 'Selasa',
                'opening_time' => '09:00:00',
                'closing_time' => '21:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '13:00', 'end' => '14:00', 'note' => 'Istirahat siang']
                ],
                'notes' => 'Jam operasional normal hari Selasa',
            ],
            [
                'day_of_week' => 'wednesday',
                'day_name_id' => 'Rabu',
                'opening_time' => '09:00:00',
                'closing_time' => '21:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '13:00', 'end' => '14:00', 'note' => 'Istirahat siang']
                ],
                'notes' => 'Jam operasional normal hari Rabu',
            ],
            [
                'day_of_week' => 'thursday',
                'day_name_id' => 'Kamis',
                'opening_time' => '09:00:00',
                'closing_time' => '21:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '13:00', 'end' => '14:00', 'note' => 'Istirahat siang']
                ],
                'notes' => 'Jam operasional normal hari Kamis',
            ],
            [
                'day_of_week' => 'friday',
                'day_name_id' => 'Jumat',
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '11:30', 'end' => '13:00', 'note' => 'Istirahat Jumat'],
                    ['start' => '15:00', 'end' => '15:30', 'note' => 'Istirahat sore']
                ],
                'notes' => 'Jam operasional Jumat dengan waktu sholat Jumat',
            ],
            [
                'day_of_week' => 'saturday',
                'day_name_id' => 'Sabtu',
                'opening_time' => '09:00:00',
                'closing_time' => '22:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '13:00', 'end' => '14:00', 'note' => 'Istirahat siang']
                ],
                'notes' => 'Jam operasional weekend - Sabtu',
            ],
            [
                'day_of_week' => 'sunday',
                'day_name_id' => 'Minggu',
                'opening_time' => '10:00:00',
                'closing_time' => '21:00:00',
                'is_open' => true,
                'is_holiday' => false,
                'break_times' => [
                    ['start' => '13:00', 'end' => '14:00', 'note' => 'Istirahat siang']
                ],
                'notes' => 'Jam operasional weekend - Minggu (buka agak siang)',
            ],
        ];

        foreach ($schedules as $schedule) {
            \App\Models\StoreSchedule::create($schedule);
        }
    }
}
