<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FAQ extends Model
{
    protected $table = 'faqs';

    protected $fillable = [
        'faq_category_id',
        'question',
        'answer',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Scope a query to only include featured items.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    /**
     * Get the answer plain text attribute.
     */
    public function getAnswerPlainAttribute(): string
    {
        return strip_tags($this->answer);
    }

    /**
     * Get the category that owns the FAQ.
     */
    public function faqCategory(): BelongsTo
    {
        return $this->belongsTo(FaqCategory::class);
    }

    /**
     * Scope a query to filter by category ID.
     */
    public function scopeByCategoryId($query, $categoryId)
    {
        return $query->where('faq_category_id', $categoryId);
    }
}
