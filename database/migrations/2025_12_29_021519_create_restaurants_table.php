<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->json('images')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->enum('type', ['restaurant', 'cafe', 'food_stall', 'tea_shop'])->default('restaurant');
            $table->json('cuisine_type')->nullable(); // ['Sri Lankan', 'Chinese', 'Italian', etc.]
            $table->integer('price_range')->default(2); // 1-4 ($, $$, $$$, $$$$)
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('facilities')->nullable(); // ['parking', 'wifi', 'ac', 'outdoor_seating', 'english_menu', etc.]
            $table->json('tags')->nullable();
            $table->string('famous_for')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('district_id');
            $table->index('slug');
            $table->index('type');
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
