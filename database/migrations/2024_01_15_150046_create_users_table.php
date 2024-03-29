<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('city');
            $table->string('password')->default('');
            $table->string('profilePictureURL')->default('pictures/no-profile-picture.jpg');
            $table->string('verificationToken')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->string('passwordResetToken')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
