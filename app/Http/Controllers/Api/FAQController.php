<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FAQController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index(Request $request): JsonResponse
    {
        $query = FAQ::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        $faqs = $query->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $faqs
        ]);
    }

    /**
     * Get featured FAQs.
     */
    public function featured(): JsonResponse
    {
        $faqs = FAQ::where('is_featured', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $faqs
        ]);
    }

    /**
     * Get FAQs by category.
     */
    public function byCategory(string $category): JsonResponse
    {
        $faqs = FAQ::byCategory($category)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $faqs
        ]);
    }
}
