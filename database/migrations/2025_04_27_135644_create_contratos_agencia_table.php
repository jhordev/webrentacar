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
        Schema::create('contratos_agencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agencia_id')->constrained('agencia')->onDelete('cascade');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('archivo_contrato')->nullable();
            $table->string('observaciones')->nullable();
            $table->enum('estado', ['activo', 'vencido', 'cancelado'])->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos_agencia');
    }
};
