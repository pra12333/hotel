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
        Schema::table('bookings', function (Blueprint $table) {
            $table->timestamp('canceled_at')->nullable()->after('payment_status'); // Timestamp for cancellation
            $table->enum('refund_status', ['pending', 'processed', 'not_applicable'])
                  ->default('not_applicable')
                  ->after('canceled_at'); // Refund status

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('canceled_at');
            $table->dropColumn('refund_status');
        });
    }
};
