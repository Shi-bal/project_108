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
        Schema::create('carts', function (Blueprint $table) {
            $table->id('cart_id');
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade'); // Explicitly reference 'user_id'
            $table->foreignId('product_id')->constrained('products', 'product_id')->onDelete('cascade'); 
            $table->string('product_title')->nullable();
            $table->string('image1')->nullable();
            $table->integer('quantity');
            $table->string('size', 20)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->foreignId('order_id')->nullable()->constrained('orders', 'order_id')->onDelete('cascade');
            $table->timestamps(0); // Timestamp columns
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
