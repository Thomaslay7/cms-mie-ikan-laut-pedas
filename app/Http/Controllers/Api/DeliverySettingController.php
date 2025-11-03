<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliverySetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliverySettingController extends Controller
{
    /**
     * Get delivery settings
     */
    public function index(): JsonResponse
    {
        try {
            $settings = DeliverySetting::first();

            if (!$settings) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Delivery settings not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Delivery settings retrieved successfully',
                'data' => [
                    'minimum_order' => $settings->minimum_order,
                    'delivery_fee' => $settings->delivery_fee,
                    'free_delivery_threshold' => $settings->free_delivery_threshold,
                    'delivery_radius_km' => $settings->delivery_radius_km,
                    'estimated_delivery_time_min' => $settings->estimated_delivery_time_min,
                    'delivery_areas' => $settings->delivery_areas,
                    'is_delivery_enabled' => $settings->is_delivery_enabled,
                    'is_pickup_enabled' => $settings->is_pickup_enabled,
                    'delivery_notes' => $settings->delivery_notes,
                    'formatted_minimum_order' => 'Rp ' . number_format($settings->minimum_order, 0, ',', '.'),
                    'formatted_delivery_fee' => 'Rp ' . number_format($settings->delivery_fee, 0, ',', '.'),
                    'formatted_free_delivery_threshold' => $settings->free_delivery_threshold
                        ? 'Rp ' . number_format($settings->free_delivery_threshold, 0, ',', '.')
                        : null,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve delivery settings',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Calculate delivery fee for specific order amount
     */
    public function calculateFee(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'order_amount' => 'required|numeric|min:0',
            ]);

            $orderAmount = $request->input('order_amount');
            $settings = DeliverySetting::first();

            if (!$settings) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Delivery settings not found',
                ], 404);
            }

            $deliveryFee = $settings->getDeliveryFee($orderAmount);
            $isFreeDelivery = $settings->isFreeDelivery($orderAmount);
            $remainingForFree = $isFreeDelivery ? 0 : ($settings->free_delivery_threshold - $orderAmount);

            return response()->json([
                'status' => 'success',
                'message' => 'Delivery fee calculated successfully',
                'data' => [
                    'order_amount' => $orderAmount,
                    'delivery_fee' => $deliveryFee,
                    'is_free_delivery' => $isFreeDelivery,
                    'minimum_order_met' => $orderAmount >= $settings->minimum_order,
                    'remaining_for_free_delivery' => max(0, $remainingForFree),
                    'total_amount' => $orderAmount + $deliveryFee,
                    'formatted' => [
                        'order_amount' => 'Rp ' . number_format($orderAmount, 0, ',', '.'),
                        'delivery_fee' => 'Rp ' . number_format($deliveryFee, 0, ',', '.'),
                        'total_amount' => 'Rp ' . number_format($orderAmount + $deliveryFee, 0, ',', '.'),
                        'remaining_for_free' => $remainingForFree > 0
                            ? 'Rp ' . number_format($remainingForFree, 0, ',', '.')
                            : null,
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to calculate delivery fee',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Check if delivery is available to specific area
     */
    public function checkAvailability(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'area' => 'required|string',
            ]);

            $area = $request->input('area');
            $settings = DeliverySetting::first();

            if (!$settings) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Delivery settings not found',
                ], 404);
            }

            $deliveryAreas = $settings->delivery_areas ?? [];
            $isAvailable = $settings->is_delivery_enabled &&
                          in_array($area, $deliveryAreas, true);

            return response()->json([
                'status' => 'success',
                'message' => 'Delivery availability checked',
                'data' => [
                    'area' => $area,
                    'is_available' => $isAvailable,
                    'delivery_enabled' => $settings->is_delivery_enabled,
                    'available_areas' => $deliveryAreas,
                    'estimated_time' => $isAvailable ? $settings->estimated_delivery_time_min : null,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to check delivery availability',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
