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
        Schema::create('store_schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('day_of_week', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->string('day_name_id')->comment('Nama hari dalam bahasa Indonesia');
            $table->time('opening_time')->nullable()->comment('Jam buka toko');
            $table->time('closing_time')->nullable()->comment('Jam tutup toko');
            $table->boolean('is_open')->default(true)->comment('Apakah toko buka di hari ini');
            $table->boolean('is_holiday')->default(false)->comment('Apakah hari ini libur/holiday');
            $table->string('holiday_note')->nullable()->comment('Catatan untuk hari libur');
            $table->json('break_times')->nullable()->comment('Jam istirahat (array of {start, end})');
            $table->text('notes')->nullable()->comment('Catatan tambahan untuk jadwal hari ini');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Unique constraint untuk memastikan setiap hari hanya ada satu record
            $table->unique('day_of_week');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_schedules');
    }
};
