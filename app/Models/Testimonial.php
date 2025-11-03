<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'customer_name',
        'customer_avatar',
        'customer_location',
        'rating',
        'review_text',
        'review_date',
        'platform',
        'is_featured',
        'is_approved',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'review_date' => 'date',
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include approved testimonials.
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope a query to only include featured testimonials.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to filter by rating.
     */
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('review_date');
    }

    /**
     * Get the star display attribute.
     */
    public function getStarDisplayAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    /**
     * Get the platform text attribute.
     */
    public function getPlatformTextAttribute(): ?string
    {
        return match($this->platform) {
            'google' => 'Google Review',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'whatsapp' => 'WhatsApp',
            'direct' => 'Langsung',
            default => null,
        };
    }

    /**
     * Get the review date formatted attribute.
     */
    public function getReviewDateFormattedAttribute(): ?string
    {
        if (!$this->review_date) {
            return null;
        }

        return $this->review_date->format('d F Y');
    }

    /**
     * Get the customer avatar URL attribute.
     */
    public function getCustomerAvatarUrlAttribute(): ?string
    {
        if ($this->customer_avatar) {
            return asset('storage/' . $this->customer_avatar);
        }

        return $this->getFirstMediaUrl('avatars');
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->sharpen(10);
    }
}
