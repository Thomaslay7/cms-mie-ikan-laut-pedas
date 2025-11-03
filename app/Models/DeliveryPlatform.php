<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_info_id',
        'name',
        'url',
        'logo_url',
        'commission_rate',
        'is_active',
        'sort_order',
        'description',
        'contact_info',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'commission_rate' => 'decimal:2',
        'contact_info' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the business info that owns the delivery platform
     */
    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class);
    }
}
