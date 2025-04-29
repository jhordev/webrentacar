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
        Schema::create('anuncio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria')->nullable()->constrained('categoria_anuncio')->cascadeOnDelete();
            $table->string('num_anuncio')->nullable();
            $table->string('titulo')->nullable();
            $table->string('descripcion', 1000)->nullable();
            $table->string('tipo')->nullable();
            $table->foreignId('vendedor_id')->nullable()->constrained('vendedor')->cascadeOnDelete();
            $table->foreignId('agencia_id')->nullable()->constrained('agencia')->cascadeOnDelete();
            $table->decimal('precio', 10, 2)->nullable();
            $table->foreignId('estado_id')->nullable()->constrained('estados')->cascadeOnDelete();
            $table->foreignId('municipio_id')->nullable()->constrained('municipios')->cascadeOnDelete();
            $table->string('link_video')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anuncio');
    }
};
