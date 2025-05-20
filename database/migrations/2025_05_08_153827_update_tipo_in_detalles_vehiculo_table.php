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
        Schema::table('detalles_vehiculo', function (Blueprint $table) {
            // Eliminar columna 'tipo' si existe
            if (Schema::hasColumn('detalles_vehiculo', 'tipo')) {
                $table->dropColumn('tipo');
            }

            // Agregar columna tipo_id y establecer la relación
            $table->unsignedBigInteger('tipo_id')->nullable()->after('anio');

            $table->foreign('tipo_id')
                ->references('id')
                ->on('tipo_vehiculo')
                ->nullOnDelete(); // o ->cascadeOnDelete() según lógica de tu app
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detalles_vehiculo', function (Blueprint $table) {
            Schema::table('detalles_vehiculo', function (Blueprint $table) {
                $table->dropForeign(['tipo_id']);
                $table->dropColumn('tipo');
                $table->string('tipo', 30)->nullable(); // lo restauramos como estaba
            });
        });
    }
};
