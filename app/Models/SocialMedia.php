<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_info_id',
        'platform',
        'url',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    public function getPlatformIconAttribute(): string
    {
        $icons = [
            'instagram' => 'fab fa-instagram',
            'facebook' => 'fab fa-facebook',
            'twitter' => 'fab fa-twitter',
            'tiktok' => 'fab fa-tiktok',
            'youtube' => 'fab fa-youtube',
            'linkedin' => 'fab fa-linkedin',
            'whatsapp' => 'fab fa-whatsapp',
        ];

        return $icons[$this->platform] ?? 'fas fa-link';
    }

    public function getPlatformColorAttribute(): string
    {
        $colors = [
            'instagram' => '#E4405F',
            'facebook' => '#1877F2',
            'twitter' => '#1DA1F2',
            'tiktok' => '#000000',
            'youtube' => '#FF0000',
            'linkedin' => '#0A66C2',
            'whatsapp' => '#25D366',
        ];

        return $colors[$this->platform] ?? '#6B7280';
    }
}
