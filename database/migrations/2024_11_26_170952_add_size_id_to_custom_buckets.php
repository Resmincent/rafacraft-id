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
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_buckets', function (Blueprint $table) {
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
        });
    }
};