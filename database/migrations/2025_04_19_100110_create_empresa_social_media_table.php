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
        Schema::create('empresa_social_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('config_empresa')->onDelete('cascade');
            $table->string('nombre_red');
            $table->string('url');
            $table->integer('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_social_media');
    }
};
