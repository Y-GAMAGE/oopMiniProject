<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('region')->nullable(); // ADD THIS: Canton, State, Province, etc.
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('attractions_count')->default(0);
             $table->string('best_season')->nullable(); // ADD THIS
            $table->integer('total_categories')->default(0); // ADD THIS
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
