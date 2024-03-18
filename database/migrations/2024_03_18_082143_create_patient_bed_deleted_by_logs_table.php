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
        Schema::create('patient_bed_deleted_by_logs', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id', 100);
            $table->string('enccode', 200);
            $table->integer('bed_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_bed_deleted_by_logs');
    }
};
