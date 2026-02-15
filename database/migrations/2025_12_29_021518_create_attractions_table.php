<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');

            // Basic Information
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->json('images')->nullable(); // ← Remove ->after('image_url')

            // Featured & Rating
            $table->boolean('is_featured')->default(false);
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('reviews_count')->default(0);

            // Entry & Facilities
            $table->decimal('entry_fee', 10, 2)->nullable();
            $table->json('facilities')->nullable(); // ['parking', 'wifi', 'restaurant', 'guide', 'wheelchair', 'restroom']

            // Operating Hours
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->boolean('is_open_now')->default(true);

            // Location Information
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Contact Information
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Visit Information
            $table->string('best_time_to_visit')->nullable();
            $table->string('duration')->nullable();
            $table->string('languages')->nullable();
            $table->json('tags')->nullable();

            $table->timestamps();

            // Indexes for better query performance
            $table->index('slug');
            $table->index('district_id');
            $table->index('category_id');
            $table->index(['latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
