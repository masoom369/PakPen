<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->foreignId('product_id')->constrained('products', 'product_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index('product_id');
            $table->index('seller_id');
            $table->index('customer_id');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
