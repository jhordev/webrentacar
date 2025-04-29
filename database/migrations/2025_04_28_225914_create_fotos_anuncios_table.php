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
        Schema::create('fotos_anuncios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anuncio_id')
                ->constrained('anuncio')
                ->cascadeOnDelete();
            $table->string('image');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos_anuncios');
    }
};
