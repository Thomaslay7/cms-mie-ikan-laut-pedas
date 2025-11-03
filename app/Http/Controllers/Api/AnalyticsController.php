<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends Controller
{
    /**
     * Track an analytics event.
     */
    public function track(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:100',
            'event_data' => 'sometimes|array',
            'user_agent' => 'sometimes|string',
            'ip_address' => 'sometimes|ip',
            'page_url' => 'sometimes|url',
        ]);

        $event = AnalyticsEvent::create([
            'event_name' => $validated['event_name'],
            'event_data' => $validated['event_data'] ?? null,
            'user_agent' => $validated['user_agent'] ?? $request->userAgent(),
            'ip_address' => $validated['ip_address'] ?? $request->ip(),
            'page_url' => $validated['page_url'] ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Event tracked successfully',
            'data' => $event
        ]);
    }
}
