<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->text('message');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

  
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};
