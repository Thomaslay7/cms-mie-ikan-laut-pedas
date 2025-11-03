<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliverySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_info_id',
        'minimum_order',
        'delivery_fee',
        'free_delivery_threshold',
        'delivery_radius_km',
        'estimated_delivery_time_min',
        'delivery_areas',
        'is_delivery_enabled',
        'is_pickup_enabled',
        'delivery_notes',
    ];

    protected $casts = [
        'minimum_order' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'free_delivery_threshold' => 'decimal:2',
        'delivery_areas' => 'array',
        'is_delivery_enabled' => 'boolean',
        'is_pickup_enabled' => 'boolean',
    ];

    public function isFreeDelivery($orderAmount): bool
    {
        return $this->free_delivery_threshold && $orderAmount >= $this->free_delivery_threshold;
    }

    public function getDeliveryFee($orderAmount): float
    {
        return $this->isFreeDelivery($orderAmount) ? 0 : (float) $this->delivery_fee;
    }

    /**
     * Get the business info that owns the delivery setting
     */
    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class);
    }
}
