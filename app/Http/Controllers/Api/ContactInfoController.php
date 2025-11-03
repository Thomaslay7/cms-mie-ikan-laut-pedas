<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\JsonResponse;

class ContactInfoController extends Controller
{
    /**
     * Get contact information
     */
    public function index(): JsonResponse
    {
        try {
            $contactInfo = ContactInfo::first();

            if (!$contactInfo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Contact information not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Contact information retrieved successfully',
                'data' => [
                    'phone' => $contactInfo->phone,
                    'formatted_phone' => $contactInfo->formatted_phone,
                    'whatsapp' => $contactInfo->whatsapp,
                    'whatsapp_url' => $contactInfo->whatsapp_url,
                    'email' => $contactInfo->email,
                    'address' => $contactInfo->address,
                    'google_maps_embed' => $contactInfo->google_maps_embed,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve contact information',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
