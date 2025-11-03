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
        Schema::create('delivery_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_info_id')->constrained('business_info')->onDelete('cascade');
            $table->decimal('minimum_order', 10, 2)->default(0);
            $table->decimal('delivery_fee', 8, 2)->default(0);
            $table->decimal('free_delivery_threshold', 10, 2)->nullable();
            $table->integer('delivery_radius_km')->default(5);
            $table->integer('estimated_delivery_time_min')->default(30);
            $table->json('delivery_areas')->nullable();
            $table->boolean('is_delivery_enabled')->default(true);
            $table->boolean('is_pickup_enabled')->default(true);
            $table->text('delivery_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_settings');
    }
};
