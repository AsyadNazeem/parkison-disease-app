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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id(); // Primary key

            // Foreign key for the logged-in user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Prediction input fields
            $table->float('MDVP_Fo_Hz');
            $table->float('MDVP_Fhi_Hz');
            $table->float('MDVP_Flo_Hz');
            $table->float('MDVP_Jitter');
            $table->float('MDVP_Jitter_Abs');
            $table->float('MDVP_RAP');
            $table->float('MDVP_PPQ');
            $table->float('Jitter_DDP');
            $table->float('MDVP_Shimmer');
            $table->float('MDVP_Shimmer_dB');
            $table->float('Shimmer_APQ3');
            $table->float('Shimmer_APQ5');
            $table->float('MDVP_APQ');
            $table->float('Shimmer_DDA');
            $table->float('NHR');
            $table->float('HNR');
            $table->float('RPDE');
            $table->float('DFA');
            $table->float('spread1');
            $table->float('spread2');
            $table->float('D2');
            $table->float('PPE');

            // Final prediction result
            $table->string('result'); // Can store 'Positive' or 'Negative'

            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_recoreds');
    }
};
