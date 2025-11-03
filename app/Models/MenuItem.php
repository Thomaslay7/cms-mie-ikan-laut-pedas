<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuItem extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'original_price',
        'image',
        'gallery',
        'ingredients',
        'nutrition_info',
        'is_featured',
        'is_available',
        'is_popular',
        'preparation_time',
        'sort_order',
        'tags',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'gallery' => 'array',
        'ingredients' => 'array',
        'nutrition_info' => 'array',
        'tags' => 'array',
        'is_featured' => 'boolean',
        'is_available' => 'boolean',
        'is_popular' => 'boolean',
        'preparation_time' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the category that owns the menu item.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the galleries for the menu item.
     */
    public function galleries(): HasMany
    {
        return $this->hasMany(MenuItemGallery::class)->ordered();
    }

    /**
     * Get the primary gallery image.
     */
    public function primaryGallery(): HasOne
    {
        return $this->hasOne(MenuItemGallery::class)->where('is_primary', true);
    }

    /**
     * Get the ingredients for the menu item.
     */
    public function itemIngredients(): HasMany
    {
        return $this->hasMany(MenuItemIngredient::class)->ordered();
    }

    /**
     * Get required ingredients only.
     */
    public function requiredIngredients(): HasMany
    {
        return $this->itemIngredients()->where('is_optional', false);
    }

    /**
     * Get allergen ingredients only.
     */
    public function allergenIngredients(): HasMany
    {
        return $this->itemIngredients()->where('is_allergen', true);
    }

    /**
     * Get the nutrition information for the menu item.
     */
    public function nutritionInfo(): HasOne
    {
        return $this->hasOne(MenuItemNutrition::class);
    }

    /**
     * Get the tags for the menu item.
     */
    public function itemTags(): HasMany
    {
        return $this->hasMany(MenuItemTag::class);
    }

    /**
     * Scope a query to only include available items.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope a query to only include featured items.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include popular items.
     */
    public function scopePopular($query)
    {
        return $query->where('is_popular', true);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get the formatted price attribute.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get the formatted original price attribute.
     */
    public function getFormattedOriginalPriceAttribute(): ?string
    {
        if (!$this->original_price) {
            return null;
        }

        return 'Rp ' . number_format($this->original_price, 0, ',', '.');
    }

    /**
     * Get the discount percentage attribute.
     */
    public function getDiscountPercentageAttribute(): ?float
    {
        if (!$this->original_price || $this->original_price <= $this->price) {
            return null;
        }

        return round((($this->original_price - $this->price) / $this->original_price) * 100, 1);
    }

    /**
     * Get the spice level text attribute.
     */
    public function getSpiceLevelTextAttribute(): ?string
    {
        return match($this->spice_level) {
            'mild' => 'Tidak Pedas',
            'medium' => 'Pedas Sedang',
            'hot' => 'Pedas',
            'extra_hot' => 'Extra Pedas',
            default => null,
        };
    }

    /**
     * Get the preparation time text attribute.
     */
    public function getPreparationTimeTextAttribute(): ?string
    {
        if (!$this->preparation_time) {
            return null;
        }

        return $this->preparation_time . ' menit';
    }

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return $this->getFirstMediaUrl('images');
    }

    /**
     * Get related items from the same category.
     */
    public function getRelatedItemsAttribute()
    {
        return self::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->available()
            ->ordered()
            ->limit(4)
            ->get();
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
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

        $this->addMediaConversion('card')
            ->width(600)
            ->height(400)
            ->sharpen(10);

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(800)
            ->sharpen(10);
    }
}
