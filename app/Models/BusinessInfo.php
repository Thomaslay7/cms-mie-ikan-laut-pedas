<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BusinessInfo extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'business_info';

    protected $fillable = [
        'business_name',
        'tagline',
        'logo',
        // Note: Other fields moved to separate tables:
        // - Hero data -> hero_sections table
        // - About data -> about_sections table
        // - Contact data -> contact_info table
        // - Social media -> social_media table
        // - Delivery platforms -> delivery_platforms table
        // - Operating hours -> operating_hours table
        // - Delivery settings -> delivery_settings table
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the first (and should be only) business info record.
     */
    public static function first()
    {
        return static::query()->first() ?? new static();
    }

    /**
     * Get the logo URL attribute.
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return asset('storage/' . $this->logo);
        }

        return $this->getFirstMediaUrl('logos');
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logos')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']);
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('logo-small')
            ->width(200)
            ->height(200)
            ->sharpen(10);
    }

    /**
     * Get hero sections for this business
     */
    public function heroSections(): HasMany
    {
        return $this->hasMany(HeroSection::class)->active()->ordered();
    }

    /**
     * Get primary hero section
     */
    public function primaryHeroSection(): HasOne
    {
        return $this->hasOne(HeroSection::class)->active()->ordered();
    }

    /**
     * Get about sections for this business
     */
    public function aboutSections(): HasMany
    {
        return $this->hasMany(AboutSection::class)->active();
    }

    /**
     * Get primary about section
     */
    public function aboutSection(): HasOne
    {
        return $this->hasOne(AboutSection::class)->active();
    }

    /**
     * Get contact information for this business
     */
    public function contactInfo(): HasOne
    {
        return $this->hasOne(ContactInfo::class);
    }

    /**
     * Get social media accounts for this business
     */
    public function socialMediaAccounts(): HasMany
    {
        return $this->hasMany(SocialMedia::class)->active()->ordered();
    }

    /**
     * Get delivery platforms for this business
     */
    public function deliveryPlatforms(): HasMany
    {
        return $this->hasMany(DeliveryPlatform::class)->active()->ordered();
    }

    /**
     * Get operating hours for this business
     */
    public function operatingHours(): HasMany
    {
        return $this->hasMany(OperatingHour::class);
    }

    /**
     * Get delivery settings for this business
     */
    public function deliverySettings(): HasOne
    {
        return $this->hasOne(DeliverySetting::class);
    }
}
