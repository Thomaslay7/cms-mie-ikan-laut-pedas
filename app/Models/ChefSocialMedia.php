<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChefSocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'chef_id',
        'platform',
        'username',
        'url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function chef(): BelongsTo
    {
        return $this->belongsTo(ChefInfo::class, 'chef_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeByPlatform($query, $platform)
    {
        return $query->where('platform', $platform);
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
        ];

        return $colors[$this->platform] ?? '#6B7280';
    }
}
