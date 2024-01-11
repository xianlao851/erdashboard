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
        Schema::create('patient_room_beds', function (Blueprint $table) {
            $table->id('patient_room_bed_id');
            $table->string('patient_id', 50);
            $table->foreignId('room_id');
            $table->foreignId('bed_id');
            $table->string('ward_code', 50);
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_room_beds');
    }
};
