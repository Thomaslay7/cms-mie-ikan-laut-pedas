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
        Schema::table('store_schedules', function (Blueprint $table) {
            // Drop unique constraint for day_of_week to allow multiple schedules per day
            $table->dropUnique(['day_of_week']);

            // Add date fields for specific date scheduling
            $table->date('specific_date')->nullable()->after('day_of_week')->comment('Tanggal spesifik untuk jadwal khusus');
            $table->enum('schedule_type', ['weekly', 'specific'])->default('weekly')->after('day_of_week')->comment('Tipe jadwal: mingguan atau tanggal spesifik');

            // Add new unique constraint for combination of schedule_type, day_of_week, and specific_date
            $table->unique(['schedule_type', 'day_of_week', 'specific_date'], 'unique_schedule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_schedules', function (Blueprint $table) {
            $table->dropUnique('unique_schedule');
            $table->dropColumn(['specific_date', 'schedule_type']);
            $table->unique('day_of_week');
        });
    }
};
