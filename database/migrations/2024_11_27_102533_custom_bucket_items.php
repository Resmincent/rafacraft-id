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
        Schema::create('custom_bucket_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_bucket_id');
            $table->unsignedBigInteger('bouquet_id');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('custom_bucket_id')->references('id')->on('custom_buckets')->onDelete('cascade');
            $table->foreign('bouquet_id')->references('id')->on('bouquets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_bucket_items');
    }
};
