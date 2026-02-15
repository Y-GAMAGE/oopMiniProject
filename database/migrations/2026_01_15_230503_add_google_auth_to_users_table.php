<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('phone')->nullable()->after('google_id');
            $table->string('country')->nullable()->after('phone');
            $table->string('profile_picture')->nullable()->after('country');
            $table->enum('role', ['user', 'admin'])->default('user')->after('profile_picture');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_id',
                'phone',
                'country',
                'profile_picture',
                'role',
                'status'
            ]);
        });
    }
};
