<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\JsonResponse;

class HeroSectionController extends Controller
{
    /**
     * Get all active hero sections
     */
    public function index(): JsonResponse
    {
        try {
            $heroSections = HeroSection::active()
                ->ordered()
                ->get()
                ->map(function ($section) {
                    return [
                        'id' => $section->id,
                        'title' => $section->title,
                        'subtitle' => $section->subtitle,
                        'image_url' => $section->image_url,
                        'cta_text' => $section->cta_text,
                        'cta_link' => $section->cta_link,
                        'display_order' => $section->display_order,
                    ];
                });

            return response()->json([
                'status' => 'success',
                'message' => 'Hero sections retrieved successfully',
                'data' => $heroSections,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve hero sections',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get primary hero section (first active)
     */
    public function primary(): JsonResponse
    {
        try {
            $heroSection = HeroSection::active()->ordered()->first();

            if (!$heroSection) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No active hero section found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Primary hero section retrieved successfully',
                'data' => [
                    'id' => $heroSection->id,
                    'title' => $heroSection->title,
                    'subtitle' => $heroSection->subtitle,
                    'image_url' => $heroSection->image_url,
                    'cta_text' => $heroSection->cta_text,
                    'cta_link' => $heroSection->cta_link,
                    'display_order' => $heroSection->display_order,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve primary hero section',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
