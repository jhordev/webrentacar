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
        Schema::table('faq_preguntas', function (Blueprint $table) {
            // Eliminar la foreign key existente (si ya fue creada antes sin cascada)
            $table->dropForeign(['categoria_id']);

            // Crear la nueva con ON DELETE CASCADE
            $table->foreign('categoria_id')
                ->references('id')
                ->on('faq_categorias')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faq_preguntas', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);

            // Restaurar a ON DELETE restrict o sin acción
            $table->foreign('categoria_id')
                ->references('id')
                ->on('faq_categorias')
                ->onDelete('restrict');
        });
    }
};
