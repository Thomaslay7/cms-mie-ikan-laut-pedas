<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('business_info', function (Blueprint $table) {
            // Remove hero-related fields (moved to hero_sections table)
            $table->dropColumn([
                'hero_image',
                'hero_title',
                'hero_subtitle',
                'hero_cta_text',
                'hero_cta_link'
            ]);

            // Remove about-related fields (moved to about_sections table)
            $table->dropColumn([
                'about_title',
                'about_description',
                'about_image'
            ]);

            // Remove contact-related fields (moved to contact_info table)
            $table->dropColumn([
                'phone',
                'whatsapp',
                'email',
                'address',
                'google_maps_embed'
            ]);

            // Remove social media fields (moved to social_media table)
            $table->dropColumn([
                'instagram_url',
                'tiktok_url',
                'facebook_url',
                'youtube_url'
            ]);

            // Remove delivery platform fields (moved to delivery_platforms table)
            $table->dropColumn([
                'grab_food_url',
                'shopee_food_url',
                'gojek_url'
            ]);

            // Remove operating hours (moved to operating_hours table)
            $table->dropColumn('operating_hours');

            // Remove delivery settings (moved to delivery_settings table)
            $table->dropColumn([
                'delivery_info',
                'minimum_order',
                'delivery_fee',
                'free_delivery_min',
                'is_delivery_available',
                'is_pickup_available'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('business_info', function (Blueprint $table) {
            // Add back all removed fields (in case we need to rollback)
            // Hero fields
            $table->string('hero_image')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_cta_text', 100)->nullable();
            $table->string('hero_cta_link')->nullable();

            // About fields
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();

            // Contact fields
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('address')->nullable();
            $table->text('google_maps_embed')->nullable();

            // Social media fields
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();

            // Delivery platform fields
            $table->string('grab_food_url')->nullable();
            $table->string('shopee_food_url')->nullable();
            $table->string('gojek_url')->nullable();

            // Operating hours
            $table->json('operating_hours')->nullable();

            // Delivery settings
            $table->text('delivery_info')->nullable();
            $table->decimal('minimum_order', 10, 2)->nullable();
            $table->decimal('delivery_fee', 10, 2)->nullable();
            $table->decimal('free_delivery_min', 10, 2)->nullable();
            $table->boolean('is_delivery_available')->default(true);
            $table->boolean('is_pickup_available')->default(true);
        });
    }
};
