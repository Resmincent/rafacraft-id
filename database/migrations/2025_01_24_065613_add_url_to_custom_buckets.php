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
            $table->string('url', 100)->nullable()->after('size_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_buckets', function (Blueprint $table) {
            $table->string('url', 100)->nullable()->after('size_id');
        });
    }
};
