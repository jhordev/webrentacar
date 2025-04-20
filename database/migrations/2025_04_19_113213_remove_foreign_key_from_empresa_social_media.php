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
        Schema::table('empresa_social_media', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropColumn('empresa_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresa_social_media', function (Blueprint $table) {
            $table->foreign('empresa_id')->references('id')->on('config_empresa')->onDelete('cascade');
            $table->unsignedBigInteger('empresa_id')->nullable();
        });
    }
};
