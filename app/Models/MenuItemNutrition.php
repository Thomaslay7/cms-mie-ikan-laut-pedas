<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItemNutrition extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_item_id',
        'calories',
        'protein_g',
        'carbs_g',
        'fat_g',
        'sugar_g',
        'sodium_mg',
        'fiber_g',
        'dietary_info',
        'allergens',
    ];

    protected $casts = [
        'calories' => 'decimal:2',
        'protein_g' => 'decimal:2',
        'carbs_g' => 'decimal:2',
        'fat_g' => 'decimal:2',
        'sugar_g' => 'decimal:2',
        'sodium_mg' => 'decimal:2',
        'fiber_g' => 'decimal:2',
    ];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function getDietaryInfoListAttribute(): array
    {
        return $this->dietary_info ? explode(',', $this->dietary_info) : [];
    }

    public function getAllergensListAttribute(): array
    {
        return $this->allergens ? explode(',', $this->allergens) : [];
    }

    public function getTotalMacrosAttribute(): float
    {
        return (float) ($this->protein_g + $this->carbs_g + $this->fat_g);
    }
}
