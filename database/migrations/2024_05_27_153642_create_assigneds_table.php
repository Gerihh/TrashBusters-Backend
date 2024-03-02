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
        Schema::create('assigneds', function (Blueprint $table) {
            $table->foreignId('eventId')->references('id')->on('events')->onDelete('cascade');
            $table->foreignId('dumpId')->references('id')->on('dumps')->onDelete('cascade');
            $table->primary('eventId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigneds');
    }
};
