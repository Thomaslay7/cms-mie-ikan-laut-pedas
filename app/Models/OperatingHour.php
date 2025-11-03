<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OperatingHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_info_id',
        'day_of_week',
        'opening_time',
        'closing_time',
        'is_closed',
        'is_24_hours',
        'notes',
    ];

    protected $casts = [
        'is_closed' => 'boolean',
        'is_24_hours' => 'boolean',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    public function scopeOpen($query)
    {
        return $query->where('is_closed', false);
    }

    public function isOpenNow(): bool
    {
        if ($this->is_closed) {
            return false;
        }

        if ($this->is_24_hours) {
            return true;
        }

        $now = now()->format('H:i');
        return $now >= $this->opening_time && $now <= $this->closing_time;
    }

    /**
     * Get the business info that owns the operating hour
     */
    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class);
    }
}
