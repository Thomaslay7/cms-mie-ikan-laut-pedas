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
        Schema::create('analytics_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 100);
            $table->string('event_category', 50)->nullable();
            $table->string('user_id', 100)->nullable();
            $table->string('session_id', 100)->nullable();
            $table->string('page_url', 500)->nullable();
            $table->string('referrer', 500)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->enum('device_type', ['desktop', 'mobile', 'tablet'])->nullable();
            $table->string('browser', 50)->nullable();
            $table->string('os', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->json('event_data')->nullable();
            $table->timestamp('created_at');

            $table->index(['event_name', 'created_at']);
            $table->index(['event_category', 'created_at']);
            $table->index('created_at');
            $table->index(['user_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics_events');
    }
};
