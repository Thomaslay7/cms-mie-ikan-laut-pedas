<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItemTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_item_id',
        'tag_name',
        'tag_color',
        'tag_description',
    ];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function scopeByTagName($query, $tagName)
    {
        return $query->where('tag_name', $tagName);
    }

    public function getColorAttribute(): string
    {
        return $this->tag_color ?: '#6B7280'; // Default gray color
    }

    public static function getPopularTags(int $limit = 10): array
    {
        return static::select('tag_name')
            ->selectRaw('COUNT(*) as usage_count')
            ->groupBy('tag_name')
            ->orderByDesc('usage_count')
            ->limit($limit)
            ->pluck('tag_name')
            ->toArray();
    }
}
