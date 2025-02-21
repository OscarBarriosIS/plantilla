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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincrementable
            $table->foreignId('user_id')->constrained('users'); // Clave foránea a la tabla 'users'
            $table->date('fecha'); // Fecha de la asistencia
            $table->time('hora_entrada')->nullable(); // Hora de entrada (puede ser nula)
            $table->time('hora_salida')->nullable(); // Hora de salida (puede ser nula)
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};