<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of active announcements.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Announcement::active()->current();

        // Filter by type if provided
        if ($request->has('type')) {
            $query->byType($request->type);
        }

        $announcements = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $announcements
        ]);
    }

    /**
     * Get announcements by type.
     */
    public function byType(string $type): JsonResponse
    {
        $announcements = Announcement::active()
            ->current()
            ->byType($type)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $announcements
        ]);
    }

    /**
     * Display the specified announcement.
     */
    public function show(string $id): JsonResponse
    {
        $announcement = Announcement::active()
            ->current()
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $announcement
        ]);
    }
}
