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
        Schema::table('custom_buckets', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['bouquet_id']);

            // Then drop the column
            $table->dropColumn('bouquet_id');
        });
    }

    public function down(): void
    {
        Schema::table('custom_buckets', function (Blueprint $table) {
            $table->foreignId('bouquet_id')->constrained('bouquets')->onDelete('cascade');
        });
    }
};
