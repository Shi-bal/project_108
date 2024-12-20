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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id('wishlist_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade'); // Explicitly reference 'user_id'
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); // Explicitly reference 'product_id'
            $table->timestamps(0); // Timestamp columns
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
