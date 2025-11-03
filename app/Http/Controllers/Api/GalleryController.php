<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery images.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Gallery::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        $galleries = $query->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $galleries
        ]);
    }

    /**
     * Get gallery images by category.
     */
    public function byCategory(string $category): JsonResponse
    {
        $galleries = Gallery::where('category', $category)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $galleries
        ]);
    }

    /**
     * Display the specified gallery image.
     */
    public function show(string $id): JsonResponse
    {
        $gallery = Gallery::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $gallery
        ]);
    }
}
