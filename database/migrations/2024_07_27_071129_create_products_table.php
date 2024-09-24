<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('p_name');
            $table->unsignedInteger('p_price'); // Unsigned integer to ensure no decimals
            $table->text('p_description');
            $table->string('p_image_path');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index(['category_id', 'seller_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
