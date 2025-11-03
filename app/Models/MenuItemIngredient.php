<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItemIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_item_id',
        'name',
        'quantity',
        'unit',
        'is_allergen',
        'is_optional',
        'sort_order',
    ];

    protected $casts = [
        'is_allergen' => 'boolean',
        'is_optional' => 'boolean',
    ];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeAllergens($query)
    {
        return $query->where('is_allergen', true);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_optional', false);
    }

    public function getFormattedQuantityAttribute(): string
    {
        if ($this->quantity && $this->unit) {
            return "{$this->quantity} {$this->unit}";
        }

        return $this->quantity ?: '';
    }
}
