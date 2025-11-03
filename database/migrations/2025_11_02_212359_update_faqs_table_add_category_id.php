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
        Schema::table('faqs', function (Blueprint $table) {
            // Add foreign key to faq_categories
            $table->foreignId('faq_category_id')->nullable()->after('id')->constrained()->onDelete('set null');

            // Drop the old enum category index first
            $table->dropIndex(['category', 'sort_order']);

            // Drop the old enum category column
            $table->dropColumn('category');
        });

        // Add new index after column changes
        Schema::table('faqs', function (Blueprint $table) {
            $table->index(['faq_category_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faqs', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['faq_category_id']);

            // Drop the new index
            $table->dropIndex(['faq_category_id', 'sort_order']);

            // Drop the column
            $table->dropColumn('faq_category_id');

            // Add back the old enum category column
            $table->enum('category', ['ordering', 'delivery', 'menu', 'payment', 'general'])->nullable()->after('answer');

            // Add back the old index
            $table->index(['category', 'sort_order']);
        });
    }
};
