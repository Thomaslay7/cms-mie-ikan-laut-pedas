<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusinessInfoController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\ChefInfoController;
use App\Http\Controllers\Api\FAQController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\CmsSettingController;
use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\StoreScheduleController;
use App\Http\Controllers\Api\OperatingHourController;
use App\Http\Controllers\Api\DeliveryPlatformController;
use App\Http\Controllers\Api\DeliverySettingController;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\AboutSectionController;
use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\SocialMediaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the `api` middleware group. Make something great!
|
*/

// Public API Routes (No Auth Required)
Route::prefix('v1')->group(function () {

    // Business Info
    Route::get('business-info', [BusinessInfoController::class, 'index']);
    Route::get('business-info/basic', [BusinessInfoController::class, 'basic']);
    Route::get('business-info/show', [BusinessInfoController::class, 'show']); // Legacy endpoint

    // Categories
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{slug}', [CategoryController::class, 'show']);

    // Menu Items
    Route::get('menu-items', [MenuItemController::class, 'index']);
    Route::get('menu-items/featured', [MenuItemController::class, 'featured']);
    Route::get('menu-items/popular', [MenuItemController::class, 'popular']);
    Route::get('menu-items/{slug}', [MenuItemController::class, 'show']);

    // Testimonials
    Route::get('testimonials', [TestimonialController::class, 'index']);
    Route::get('testimonials/featured', [TestimonialController::class, 'featured']);
    Route::get('testimonials/stats', [TestimonialController::class, 'stats']);

    // Gallery
    Route::get('gallery', [GalleryController::class, 'index']);
    Route::get('gallery/categories', [GalleryController::class, 'categories']);

    // Chef Info
    Route::get('chefs', [ChefInfoController::class, 'index']);
    Route::get('chefs/head-chef', [ChefInfoController::class, 'headChef']);

    // FAQs
    Route::get('faqs', [FAQController::class, 'index']);
    Route::get('faqs/categories', [FAQController::class, 'categories']);

    // Announcements
    Route::get('announcements', [AnnouncementController::class, 'index']);
    Route::get('announcements/current', [AnnouncementController::class, 'current']);

    // CMS Settings (Public only)
    Route::get('settings', [CmsSettingController::class, 'index']);
    Route::get('settings/{key}', [CmsSettingController::class, 'show']);

    // Analytics (Public tracking)
    Route::post('analytics/track', [AnalyticsController::class, 'track'])
        ->middleware('throttle:analytics');
    Route::post('analytics/batch-track', [AnalyticsController::class, 'batchTrack'])
        ->middleware('throttle:analytics');

    // Store Schedule
    Route::get('store-schedules', [StoreScheduleController::class, 'index']);
    Route::get('store-schedules/today', [StoreScheduleController::class, 'today']);
    Route::get('store-schedules/current-status', [StoreScheduleController::class, 'currentStatus']);
    Route::get('store-schedules/{day}', [StoreScheduleController::class, 'show']);

    // Operating Hours
    Route::get('operating-hours', [OperatingHourController::class, 'index']);
    Route::get('operating-hours/is-open', [OperatingHourController::class, 'isOpen']);

    // Delivery Platforms
    Route::get('delivery-platforms', [DeliveryPlatformController::class, 'index']);
    Route::get('delivery-platforms/by-preference', [DeliveryPlatformController::class, 'byPreference']);
    Route::get('delivery-platforms/{id}', [DeliveryPlatformController::class, 'show']);

    // Delivery Settings
    Route::get('delivery-settings', [DeliverySettingController::class, 'index']);
    Route::post('delivery-settings/calculate-fee', [DeliverySettingController::class, 'calculateFee']);
    Route::post('delivery-settings/check-availability', [DeliverySettingController::class, 'checkAvailability']);

    // Hero Sections
    Route::get('hero-sections', [HeroSectionController::class, 'index']);
    Route::get('hero-sections/primary', [HeroSectionController::class, 'primary']);

    // About Section
    Route::get('about', [AboutSectionController::class, 'index']);

    // Contact Information
    Route::get('contact-info', [ContactInfoController::class, 'index']);

    // Social Media
    Route::get('social-media', [SocialMediaController::class, 'index']);
});

// Protected API Routes (Require Admin Auth)
Route::prefix('v1/admin')->middleware(['auth:sanctum'])->group(function () {

    // Analytics (Admin only)
    Route::get('analytics/dashboard', [AnalyticsController::class, 'dashboard']);
    Route::get('analytics/events', [AnalyticsController::class, 'events']);
    Route::get('analytics/export', [AnalyticsController::class, 'export']);

    // User info
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
