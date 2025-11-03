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
        Schema::create('delivery_platforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_info_id')->constrained('business_info')->onDelete('cascade');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('logo_url')->nullable();
            $table->decimal('commission_rate', 5, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->text('description')->nullable();
            $table->json('contact_info')->nullable();
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_platforms');
    }
};
