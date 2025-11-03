<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsEvent extends Model
{
    protected $table = 'analytics_events';
    public $timestamps = false; // Only created_at

    protected $fillable = [
        'event_name',
        'event_category',
        'user_id',
        'session_id',
        'page_url',
        'referrer',
        'user_agent',
        'ip_address',
        'device_type',
        'browser',
        'os',
        'country',
        'city',
        'event_data',
    ];

    protected $casts = [
        'event_data' => 'array',
        'created_at' => 'datetime',
    ];
}
