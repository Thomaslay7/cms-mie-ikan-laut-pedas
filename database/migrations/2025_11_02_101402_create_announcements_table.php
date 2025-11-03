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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('cta_text', 100)->nullable();
            $table->string('cta_link')->nullable();
            $table->enum('type', ['popup', 'banner', 'notification']);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->boolean('is_active')->default(false);
            $table->json('target_pages')->nullable();
            $table->enum('show_frequency', ['once', 'daily', 'always'])->default('once');
            $table->timestamps();

            $table->index(['is_active', 'type']);
            $table->index(['start_date', 'end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
