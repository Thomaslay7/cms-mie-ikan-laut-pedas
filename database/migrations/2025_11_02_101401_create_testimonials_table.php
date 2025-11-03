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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100);
            $table->string('customer_avatar')->nullable();
            $table->string('customer_location', 100)->nullable();
            $table->tinyInteger('rating')->unsigned();
            $table->text('review_text');
            $table->date('review_date')->nullable();
            $table->enum('platform', ['google', 'instagram', 'facebook', 'whatsapp', 'direct'])->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_approved', 'is_featured']);
            $table->index('rating');
            $table->index('review_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
