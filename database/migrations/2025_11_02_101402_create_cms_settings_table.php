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
        Schema::create('cms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->enum('type', ['text', 'number', 'boolean', 'json', 'image', 'file']);
            $table->string('group', 50)->nullable();
            $table->string('label', 150)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamps();

            $table->index(['group', 'is_public']);
            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_settings');
    }
};
