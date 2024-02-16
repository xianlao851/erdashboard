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
        Schema::create('erdash_patient_beds', function (Blueprint $table) {
            $table->id('patient_bed_id');
            $table->string('patient_id', 20);
            $table->foreignId('bed_id');
            $table->foreignId('room_id');
            $table->string('ward_code', 10);
            $table->string('enccode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_beds');
    }
};
