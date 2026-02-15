<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->morphs('reviewable'); // reviewable_id, reviewable_type
            $table->string('user_name');
            $table->string('user_avatar')->nullable();
            $table->decimal('rating', 2, 1);
            $table->string('title')->nullable();
            $table->text('comment');
            $table->integer('helpful_count')->default(0);
            $table->date('visit_date')->nullable();
            $table->timestamps();

            //$table->index(['reviewable_type', 'reviewable_id']);
            $table->index('rating');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
