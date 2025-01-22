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
        Schema::table('consultation_dates', function (Blueprint $table) {
            $table->unsignedInteger('booked_count')->default(0)->after('max_bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::table('consultation_dates', function (Blueprint $table) {
            $table->dropColumn('booked_count');
        });
    }
};
