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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_type');    // e.g deluxe
            $table->text('description')->nullable();
            $table->decimal('price',8,2);
            $table->date('available_from');
            $table->date('available_to');
            $table->integer('available_rooms');
            $table->integer('max_children')->nullable();
            $table->integer('max_adults')->nullable();
            $table->boolean('free_pickup')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
