<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInfo extends Model
{
    use HasFactory;

    protected $table = 'contact_info';

    protected $fillable = [
        'business_info_id',
        'phone',
        'whatsapp',
        'email',
        'address',
        'google_maps_embed',
    ];

    public function businessInfo(): BelongsTo
    {
        return $this->belongsTo(BusinessInfo::class);
    }

    public function getWhatsappUrlAttribute(): ?string
    {
        return $this->whatsapp ? "https://wa.me/{$this->whatsapp}" : null;
    }

    public function getFormattedPhoneAttribute(): ?string
    {
        return $this->phone ? preg_replace('/(\d{2,4})(\d{4})(\d{4,})/', '$1-$2-$3', $this->phone) : null;
    }
}
