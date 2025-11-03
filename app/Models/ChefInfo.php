<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ChefInfo extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'chef_info';

    protected $fillable = [
        'name',
        'title',
        'bio',
        'avatar',
        'experience_years',
        'speciality',
        'is_head_chef',
        'is_featured',
        'social_instagram',
        'social_tiktok',
        'sort_order',
    ];

    protected $casts = [
        'is_head_chef' => 'boolean',
        'is_featured' => 'boolean',
        'experience_years' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include featured chefs.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include head chefs.
     */
    public function scopeHeadChef($query)
    {
        return $query->where('is_head_chef', true);
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('profile')
            ->width(500)
            ->height(500)
            ->quality(90);
    }

    /**
     * Get the chef's social media links.
     */
    public function socialMedia(): HasMany
    {
        return $this->hasMany(ChefSocialMedia::class, 'chef_info_id');
    }

    /**
     * Get the social media accounts for the chef.
     */
    public function socialMediaAccounts(): HasMany
    {
        return $this->hasMany(ChefSocialMedia::class, 'chef_id')->active()->ordered();
    }

    /**
     * Get social media by platform.
     */
    public function getSocialMediaByPlatform(string $platform): ?ChefSocialMedia
    {
        return $this->socialMediaAccounts()->where('platform', $platform)->first();
    }
}
