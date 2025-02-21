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
        Schema::create('sepomexes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_postal', 10);
            $table->string('asentamiento', 100);
            $table->string('tipo_asentamiento', 100);
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->unsignedBigInteger('id_estado')->default(0);
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->integer('id_conapo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepomexes');
    }
};
