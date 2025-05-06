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
        Schema::create('modelo_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marca_vehiculo')->onDelete('restrict');
            $table->string('modelo', 255)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelo_vehiculo');
    }
};
