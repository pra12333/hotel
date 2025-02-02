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
        Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('room_id');
        $table->date('check_in');
        $table->date('check_out');
        $table->integer('adults');
        $table->integer('children')->default(0);
        $table->decimal('total_price', 10, 2);
        $table->string('payment_status')->default('pending'); // e.g., 'paid', 'pending'
        $table->string('reference_number')->unique();
        $table->timestamps();
        // Foreign key constraints (optional)
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
    });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
