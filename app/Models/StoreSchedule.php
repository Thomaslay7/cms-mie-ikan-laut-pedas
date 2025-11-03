<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class StoreSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'day_of_week',
        'day_name_id',
        'schedule_type',
        'specific_date',
        'opening_time',
        'closing_time',
        'is_open',
        'is_holiday',
        'holiday_note',
        'break_times',
        'notes',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specific_date' => 'date',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
        'is_open' => 'boolean',
        'is_holiday' => 'boolean',
        'is_active' => 'boolean',
        'break_times' => 'array',
    ];

    /**
     * Days of week mapping
     */
    public static function getDaysMapping(): array
    {
        return [
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu',
        ];
    }

    /**
     * Get day name in Indonesian
     */
    public function getDayNameAttribute(): string
    {
        return self::getDaysMapping()[$this->day_of_week] ?? $this->day_of_week;
    }

    /**
     * Check if store is currently open
     */
    public function isCurrentlyOpen(): bool
    {
        if (!$this->is_open || $this->is_holiday) {
            return false;
        }

        $now = now()->format('H:i');
        $opening = $this->opening_time?->format('H:i');
        $closing = $this->closing_time?->format('H:i');

        if (!$opening || !$closing) {
            return false;
        }

        return $now >= $opening && $now <= $closing;
    }

    /**
     * Get formatted opening hours
     */
    public function getFormattedHoursAttribute(): string
    {
        if ($this->is_holiday) {
            return 'Libur' . ($this->holiday_note ? ' - ' . $this->holiday_note : '');
        }

        if (!$this->is_open) {
            return 'Tutup';
        }

        if (!$this->opening_time || !$this->closing_time) {
            return 'Jam belum ditentukan';
        }

        return $this->opening_time->format('H:i') . ' - ' . $this->closing_time->format('H:i');
    }

    /**
     * Scope for open days
     */
    public function scopeOpen($query)
    {
        return $query->where('is_open', true)
                    ->where('is_holiday', false)
                    ->where('is_active', true);
    }

    /**
     * Scope for holidays
     */
    public function scopeHolidays($query)
    {
        return $query->where('is_holiday', true);
    }

    /**
     * Get schedule types mapping
     */
    public static function getScheduleTypesMapping(): array
    {
        return [
            'weekly' => 'Jadwal Mingguan',
            'specific' => 'Tanggal Spesifik',
        ];
    }

    /**
     * Scope for weekly schedules
     */
    public function scopeWeekly($query)
    {
        return $query->where('schedule_type', 'weekly');
    }

    /**
     * Scope for specific date schedules
     */
    public function scopeSpecific($query)
    {
        return $query->where('schedule_type', 'specific');
    }

    /**
     * Get today's schedule including specific date overrides
     */
    public static function getTodaySchedule(): ?self
    {
        $today = now()->format('Y-m-d');
        $dayOfWeek = strtolower(now()->format('l')); // monday, tuesday, etc.

        // First, check for specific date schedule
        $specificSchedule = self::where('schedule_type', 'specific')
            ->where('specific_date', $today)
            ->first();

        if ($specificSchedule) {
            return $specificSchedule;
        }

        // Fall back to weekly schedule
        return self::where('schedule_type', 'weekly')
            ->where('day_of_week', $dayOfWeek)
            ->first();
    }

    /**
     * Get schedule for specific date
     */
    public static function getScheduleForDate(string $date): ?self
    {
        $dayOfWeek = strtolower(date('l', strtotime($date)));

        // First, check for specific date schedule
        $specificSchedule = self::where('schedule_type', 'specific')
            ->where('specific_date', $date)
            ->first();

        if ($specificSchedule) {
            return $specificSchedule;
        }

        // Fall back to weekly schedule for that day
        return self::where('schedule_type', 'weekly')
            ->where('day_of_week', $dayOfWeek)
            ->first();
    }
}
