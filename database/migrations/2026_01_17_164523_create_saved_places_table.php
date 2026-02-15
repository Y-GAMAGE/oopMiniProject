<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_places', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('saveable_type'); // Attraction, Accommodation, Restaurant
            $table->unsignedBigInteger('saveable_id');
            $table->string('notes')->nullable();
            $table->timestamps();

            // Composite index for polymorphic relationship
            $table->index(['saveable_type', 'saveable_id']);

            // Ensure user can't save same place twice
            $table->unique(['user_id', 'saveable_type', 'saveable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_places');
    }
};
