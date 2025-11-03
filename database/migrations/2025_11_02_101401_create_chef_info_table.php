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
        Schema::create('chef_info', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('title', 100)->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('experience_years')->nullable();
            $table->string('speciality')->nullable();
            $table->boolean('is_head_chef')->default(false);
            $table->boolean('is_featured')->default(true);
            $table->string('social_instagram')->nullable();
            $table->string('social_tiktok')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_featured', 'sort_order']);
            $table->index('is_head_chef');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef_info');
    }
};
