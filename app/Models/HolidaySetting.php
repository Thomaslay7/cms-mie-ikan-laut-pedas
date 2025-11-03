<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HolidaySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'is_recurring',
        'recurrence_type',
        'description',
        'is_closed',
        'special_opening_time',
        'special_closing_time',
    ];

    protected $casts = [
        'date' => 'date',
        'is_recurring' => 'boolean',
        'is_closed' => 'boolean',
        'special_opening_time' => 'datetime:H:i',
        'special_closing_time' => 'datetime:H:i',
    ];

    public function scopeActive($query, $date = null)
    {
        $checkDate = $date ? Carbon::parse($date) : now();

        return $query->where(function ($q) use ($checkDate) {
            $q->where('date', $checkDate->toDateString())
              ->orWhere(function ($subQ) use ($checkDate) {
                  $subQ->where('is_recurring', true)
                       ->where(function ($recurQ) use ($checkDate) {
                           $recurQ->where('recurrence_type', 'yearly')
                                  ->whereRaw('MONTH(date) = ? AND DAY(date) = ?',
                                           [$checkDate->month, $checkDate->day])
                                  ->orWhere(function ($monthlyQ) use ($checkDate) {
                                      $monthlyQ->where('recurrence_type', 'monthly')
                                               ->whereRaw('DAY(date) = ?', [$checkDate->day]);
                                  });
                       });
              });
        });
    }

    public function isActiveToday(): bool
    {
        return $this->scopeActive(static::query())->exists();
    }
}
