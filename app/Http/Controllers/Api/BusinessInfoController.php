<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessInfo;
use Illuminate\Http\JsonResponse;

class BusinessInfoController extends Controller
{
    /**
     * Get business information with all related data
     */
    public function index(): JsonResponse
    {
        $businessInfo = BusinessInfo::with([
            'heroSections',
            'aboutSection',
            'contactInfo',
            'socialMediaAccounts',
            'deliveryPlatforms',
            'operatingHours',
            'deliverySettings'
        ])->first();

        if (!$businessInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Business information not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Business information retrieved successfully',
            'data' => [
                'business_name' => $businessInfo->business_name,
                'tagline' => $businessInfo->tagline,
                'logo' => $businessInfo->logo_url,
                'hero_sections' => $businessInfo->heroSections,
                'about' => $businessInfo->aboutSection,
                'contact' => $businessInfo->contactInfo,
                'social_media' => $businessInfo->socialMediaAccounts,
                'delivery_platforms' => $businessInfo->deliveryPlatforms,
                'operating_hours' => $businessInfo->operatingHours,
                'delivery_settings' => $businessInfo->deliverySettings,
            ]
        ]);
    }

    /**
     * Get basic business information only
     */
    public function basic(): JsonResponse
    {
        $businessInfo = BusinessInfo::first();

        if (!$businessInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Business information not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Basic business information retrieved successfully',
            'data' => [
                'business_name' => $businessInfo->business_name,
                'tagline' => $businessInfo->tagline,
                'logo' => $businessInfo->logo_url,
            ]
        ]);
    }

    /**
     * Legacy endpoint - redirects to new structure
     * @deprecated Use /api/business-info instead
     */
    public function show(): JsonResponse
    {
        return $this->index();
    }
}
