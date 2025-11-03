<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CmsSetting;
use Illuminate\Http\JsonResponse;

class CmsSettingController extends Controller
{
    /**
     * Get all CMS settings.
     */
    public function index(): JsonResponse
    {
        $settings = CmsSetting::all()->pluck('value', 'key');

        return response()->json([
            'status' => 'success',
            'data' => $settings
        ]);
    }

    /**
     * Get specific setting by key.
     */
    public function show(string $key): JsonResponse
    {
        $setting = CmsSetting::where('key', $key)->first();

        if (!$setting) {
            return response()->json([
                'status' => 'error',
                'message' => 'Setting not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $setting->value
        ]);
    }
}
