<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientDetailsToConsultantBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultant_bookings', function (Blueprint $table) {
            $table->string('patient_name');
            $table->string('contact_number');
            $table->string('email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultant_bookings', function (Blueprint $table) {
            $table->dropColumn(['patient_name', 'contact_number', 'email']);
        });
    }
}

