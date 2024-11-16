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
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('full_name', 100);
            $table->string('phone_number', 20);
            $table->string('address', 100);
            $table->string('city', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('full_name', 100);
            $table->string('phone_number', 20);
            $table->string('address', 100);
            $table->string('city', 50);
        });
    }
};