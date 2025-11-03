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
        Schema::create('menu_item_nutrition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained()->onDelete('cascade');
            $table->decimal('calories', 6, 2)->nullable();
            $table->decimal('protein_g', 6, 2)->nullable();
            $table->decimal('carbs_g', 6, 2)->nullable();
            $table->decimal('fat_g', 6, 2)->nullable();
            $table->decimal('sugar_g', 6, 2)->nullable();
            $table->decimal('sodium_mg', 8, 2)->nullable();
            $table->decimal('fiber_g', 6, 2)->nullable();
            $table->text('dietary_info')->nullable(); // vegetarian, halal, etc.
            $table->text('allergens')->nullable();
            $table->timestamps();

            $table->unique('menu_item_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_nutrition');
    }
};
