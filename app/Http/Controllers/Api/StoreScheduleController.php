<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoreScheduleResource;
use App\Models\StoreSchedule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StoreScheduleController extends Controller
{
    /**
     * Display a listing of all store schedules.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $schedules = StoreSchedule::where('is_active', true)
            ->orderByRaw("FIELD(day_of_week, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday')")
            ->get();

        return StoreScheduleResource::collection($schedules);
    }

    /**
     * Get today's schedule.
     *
     * @return StoreScheduleResource|JsonResponse
     */
    public function today()
    {
        $today = StoreSchedule::getTodaySchedule();

        if (!$today) {
            return response()->json([
                'message' => 'Jadwal hari ini tidak ditemukan'
            ], 404);
        }

        return new StoreScheduleResource($today);
    }

    /**
     * Get current store open/close status.
     *
     * @return JsonResponse
     */
    public function currentStatus(): JsonResponse
    {
        $today = StoreSchedule::getTodaySchedule();

        if (!$today) {
            return response()->json([
                'is_open' => false,
                'status' => 'closed',
                'message' => 'Jadwal tidak tersedia',
                'next_opening' => null
            ]);
        }

        $isOpen = $today->isCurrentlyOpen();
        $status = $isOpen ? 'open' : 'closed';

        // Get next opening time
        $nextOpening = null;
        if (!$isOpen && $today->is_open && !$today->is_holiday && $today->opening_time) {
            $now = now();
            $openingToday = $now->copy()->setTimeFromTimeString($today->opening_time->format('H:i:s'));

            if ($now->lt($openingToday)) {
                $nextOpening = $openingToday->toDateTimeString();
            } else {
                // Find next day's opening
                $tomorrow = StoreSchedule::where('is_active', true)
                    ->where('is_open', true)
                    ->where('is_holiday', false)
                    ->whereNotNull('opening_time')
                    ->orderByRaw("FIELD(day_of_week, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday')")
                    ->get();

                $currentDay = strtolower($now->format('l'));
                $nextDay = $tomorrow->first(function($schedule) use ($currentDay) {
                    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                    $currentIndex = array_search($currentDay, $days);
                    $scheduleIndex = array_search($schedule->day_of_week, $days);
                    return $scheduleIndex > $currentIndex;
                });

                if ($nextDay) {
                    $nextOpening = $now->copy()
                        ->addDays(array_search($nextDay->day_of_week, ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']) - array_search($currentDay, ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']))
                        ->setTimeFromTimeString($nextDay->opening_time->format('H:i:s'))
                        ->toDateTimeString();
                }
            }
        }

        return response()->json([
            'is_open' => $isOpen,
            'status' => $status,
            'message' => $isOpen ? 'Toko sedang buka' : ($today->is_holiday ? 'Hari ini libur' : 'Toko sedang tutup'),
            'current_time' => now()->format('H:i'),
            'today_schedule' => new StoreScheduleResource($today),
            'next_opening' => $nextOpening
        ]);
    }

    /**
     * Display the schedule for a specific day.
     *
     * @param string $day
     * @return StoreScheduleResource|JsonResponse
     */
    public function show(string $day)
    {
        // Convert day name to lowercase for consistency
        $day = strtolower($day);

        // Allow both English and Indonesian day names
        $dayMapping = [
            'senin' => 'monday',
            'selasa' => 'tuesday',
            'rabu' => 'wednesday',
            'kamis' => 'thursday',
            'jumat' => 'friday',
            'sabtu' => 'saturday',
            'minggu' => 'sunday'
        ];

        $searchDay = $dayMapping[$day] ?? $day;

        $schedule = StoreSchedule::where('day_of_week', $searchDay)
            ->where('is_active', true)
            ->first();

        if (!$schedule) {
            return response()->json([
                'message' => "Jadwal untuk hari {$day} tidak ditemukan"
            ], 404);
        }

        return new StoreScheduleResource($schedule);
    }
}
