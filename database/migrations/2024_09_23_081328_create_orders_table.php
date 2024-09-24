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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('book_id')->nullable()->constrained('books', 'book_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('order_price'); // Unsigned integer to avoid decimals
            $table->unsignedInteger('order_quantity');
            $table->enum('order_status', ['processing', 'ready', 'delivering', 'delivered'])->default('processing');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index(['seller_id', 'customer_id', 'product_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
