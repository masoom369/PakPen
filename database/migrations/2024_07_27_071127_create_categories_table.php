<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('c_name', 50)->unique();
            $table->text('c_image_path');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }


     
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
