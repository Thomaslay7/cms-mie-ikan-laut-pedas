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
        Schema::create('chef_social_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chef_id')->constrained('chef_info')->onDelete('cascade');
            $table->enum('platform', ['instagram', 'facebook', 'twitter', 'tiktok', 'youtube', 'linkedin']);
            $table->string('username')->nullable();
            $table->string('url');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['chef_id', 'platform']);
            $table->index(['chef_id', 'is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef_social_media');
    }
};
