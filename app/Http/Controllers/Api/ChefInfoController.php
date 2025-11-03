<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChefInfo;
use Illuminate\Http\JsonResponse;

class ChefInfoController extends Controller
{
    /**
     * Display a listing of chefs.
     */
    public function index(): JsonResponse
    {
        $chefs = ChefInfo::where('is_featured', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $chefs
        ]);
    }

    /**
     * Get featured chefs.
     */
    public function featured(): JsonResponse
    {
        $chefs = ChefInfo::featured()
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $chefs
        ]);
    }

    /**
     * Get head chef.
     */
    public function headChef(): JsonResponse
    {
        $chef = ChefInfo::headChef()->first();

        return response()->json([
            'status' => 'success',
            'data' => $chef
        ]);
    }

    /**
     * Display the specified chef.
     */
    public function show(string $id): JsonResponse
    {
        $chef = ChefInfo::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $chef
        ]);
    }
}
