<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OperatingHour;
use Illuminate\Http\JsonResponse;

class OperatingHourController extends Controller
{
    /**
     * Get all operating hours
     */
    public function index(): JsonResponse
    {
        try {
            $operatingHours = OperatingHour::all()->keyBy('day_of_week');

            $formattedHours = [];
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            foreach ($days as $day) {
                $hour = $operatingHours->get($day);
                $formattedHours[$day] = [
                    'day' => ucfirst($day),
                    'day_indonesian' => $this->getIndonesianDay($day),
                    'is_closed' => $hour ? $hour->is_closed : true,
                    'is_24_hours' => $hour ? $hour->is_24_hours : false,
                    'opening_time' => $hour && !$hour->is_closed ? $hour->opening_time : null,
                    'closing_time' => $hour && !$hour->is_closed ? $hour->closing_time : null,
                    'notes' => $hour ? $hour->notes : null,
                    'is_open_now' => $hour ? $hour->isOpenNow() : false,
                ];
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Operating hours retrieved successfully',
                'data' => $formattedHours,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve operating hours',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if restaurant is currently open
     */
    public function isOpen(): JsonResponse
    {
        try {
            $today = strtolower(now()->format('l'));
            $todayHour = OperatingHour::where('day_of_week', $today)->first();

            $isOpen = $todayHour ? $todayHour->isOpenNow() : false;

            return response()->json([
                'status' => 'success',
                'message' => 'Restaurant status retrieved successfully',
                'data' => [
                    'is_open' => $isOpen,
                    'current_time' => now()->format('H:i'),
                    'current_day' => ucfirst($today),
                    'current_day_indonesian' => $this->getIndonesianDay($today),
                    'operating_hours' => $todayHour ? [
                        'opening_time' => $todayHour->opening_time,
                        'closing_time' => $todayHour->closing_time,
                        'is_24_hours' => $todayHour->is_24_hours,
                        'notes' => $todayHour->notes,
                    ] : null,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to check restaurant status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get Indonesian day name
     */
    private function getIndonesianDay(string $englishDay): string
    {
        $days = [
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu',
        ];

        return $days[$englishDay] ?? $englishDay;
    }
}
