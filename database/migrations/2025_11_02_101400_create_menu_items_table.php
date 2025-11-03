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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->text('description')->nullable();
            $table->string('short_description', 500)->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('original_price', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->json('ingredients')->nullable();
            $table->json('nutrition_info')->nullable();
            $table->enum('spice_level', ['mild', 'medium', 'hot', 'extra_hot'])->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->integer('preparation_time')->nullable()->comment('in minutes');
            $table->integer('sort_order')->default(0);
            $table->json('tags')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->index(['category_id', 'sort_order']);
            $table->index(['is_featured', 'is_available']);
            $table->index(['is_popular', 'is_available']);
            $table->index('slug');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
