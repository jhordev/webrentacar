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
        Schema::create('detalles_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anuncio_id')->constrained('anuncio')->onDelete('cascade');
            $table->foreignId('modelo_id')->constrained('modelo_vehiculo')->onDelete('restrict');

            $table->integer('anio')->nullable();
            $table->string('tipo', 30)->nullable();
            $table->string('combustible', 30)->nullable();
            $table->string('motor', 50)->nullable();
            $table->string('color', 30)->nullable();
            $table->string('vestidura', 30)->nullable();
            $table->unsignedInteger('kilometraje')->nullable();
            $table->unsignedTinyInteger('num_puerta')->nullable();
            $table->unsignedTinyInteger('num_pasajero')->nullable();
            $table->string('vidrios', 30)->nullable();
            $table->string('condicion', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_vehiculo');
    }
};
