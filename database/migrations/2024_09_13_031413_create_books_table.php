<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('seller_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('b_name');
            $table->integer('b_price')->default(0);
            $table->text('b_description');
            $table->string('b_image_path');
            $table->string('b_pdf_path');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->index('category_id');
            $table->index('seller_id');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
