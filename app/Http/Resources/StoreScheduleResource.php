<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'day_of_week' => $this->day_of_week,
            'day_name' => $this->day_name_id,
            'day_name_en' => ucfirst($this->day_of_week),
            'is_open' => $this->is_open,
            'is_holiday' => $this->is_holiday,
            'opening_time' => $this->opening_time?->format('H:i'),
            'closing_time' => $this->closing_time?->format('H:i'),
            'formatted_hours' => $this->formatted_hours,
            'holiday_note' => $this->holiday_note,
            'break_times' => $this->break_times ?? [],
            'notes' => $this->notes,
            'is_currently_open' => $this->isCurrentlyOpen(),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
