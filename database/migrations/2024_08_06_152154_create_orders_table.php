<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products', 'product_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('p_price');
            $table->integer('p_quantity');
            $table->enum('order_status', ['processing', 'ready', 'delivering', 'delivered'])->default('processing');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index('seller_id');
            $table->index('customer_id');
            $table->index('product_id');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
