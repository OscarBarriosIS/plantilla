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
        Schema::create('documento_ines', function (Blueprint $table) {
            $table->id();
            $table->String('clave_elector',18);
            $table->String('curp',18);
            $table->String('nombre');
            $table->String('paterno');
            $table->String('materno');
            $table->String('direccion');
            $table->String('seccion',4);
            $table->String('sexo');
            $table->String('fecha_registro');
            $table->String('fecha_emision');
            $table->String('fecha_expiracion');
            $table->String('ine');
            $table->String('retrato');
            $table->String('firma');
            $table->String('version_ine');
            $table->String('estatus');
            $table->string('fecha_nacimiento')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->string('codigo')->nullable();
            $table->string('codigo_alta')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('documento_ines');
    }
};
