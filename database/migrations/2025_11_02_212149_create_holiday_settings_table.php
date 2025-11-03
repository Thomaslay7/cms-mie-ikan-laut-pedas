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
        Schema::create('holiday_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->boolean('is_recurring')->default(false);
            $table->enum('recurrence_type', ['yearly', 'monthly'])->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_closed')->default(true);
            $table->time('special_opening_time')->nullable();
            $table->time('special_closing_time')->nullable();
            $table->timestamps();

            $table->index(['date', 'is_closed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holiday_settings');
    }
};
