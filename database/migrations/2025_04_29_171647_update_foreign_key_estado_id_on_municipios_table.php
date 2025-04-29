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
        Schema::table('municipios', function (Blueprint $table) {
            // Primero eliminamos la foreign key existente
            $table->dropForeign(['estado_id']);

            // Luego la volvemos a crear con ON DELETE CASCADE
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('municipios', function (Blueprint $table) {
            $table->dropForeign(['estado_id']);

            // Restauramos la foreign key original con RESTRICT
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados')
                ->onDelete('restrict');
        });
    }
};
