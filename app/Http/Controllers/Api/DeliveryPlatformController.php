<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPlatform;
use Illuminate\Http\JsonResponse;

class DeliveryPlatformController extends Controller
{
    /**
     * Get all active delivery platforms
     */
    public function index(): JsonResponse
    {
        try {
            $platforms = DeliveryPlatform::active()
                ->ordered()
                ->get()
                ->map(function ($platform) {
                    return [
                        'id' => $platform->id,
                        'name' => $platform->name,
                        'url' => $platform->url,
                        'logo_url' => $platform->logo_url ? asset('storage/' . $platform->logo_url) : null,
                        'description' => $platform->description,
                        'commission_rate' => $platform->commission_rate,
                        'contact_info' => $platform->contact_info,
                        'sort_order' => $platform->sort_order,
                    ];
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Delivery platforms retrieved successfully',
                'data' => $platforms,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve delivery platforms',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get specific delivery platform by ID
     */
    public function show(int $id): JsonResponse
    {
        try {
            $platform = DeliveryPlatform::active()->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'message' => 'Delivery platform retrieved successfully',
                'data' => [
                    'id' => $platform->id,
                    'name' => $platform->name,
                    'url' => $platform->url,
                    'logo_url' => $platform->logo_url ? asset('storage/' . $platform->logo_url) : null,
                    'description' => $platform->description,
                    'commission_rate' => $platform->commission_rate,
                    'contact_info' => $platform->contact_info,
                    'sort_order' => $platform->sort_order,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Delivery platform not found',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Get platforms by preference (lowest commission first)
     */
    public function byPreference(): JsonResponse
    {
        try {
            $platforms = DeliveryPlatform::active()
                ->orderBy('commission_rate', 'asc')
                ->orderBy('sort_order', 'asc')
                ->get()
                ->map(function ($platform) {
                    return [
                        'id' => $platform->id,
                        'name' => $platform->name,
                        'url' => $platform->url,
                        'logo_url' => $platform->logo_url ? asset('storage/' . $platform->logo_url) : null,
                        'description' => $platform->description,
                        'commission_rate' => $platform->commission_rate,
                        'is_recommended' => $platform->commission_rate == 0, // WhatsApp etc
                        'contact_info' => $platform->contact_info,
                    ];
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Delivery platforms retrieved by preference',
                'data' => $platforms,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve delivery platforms',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
