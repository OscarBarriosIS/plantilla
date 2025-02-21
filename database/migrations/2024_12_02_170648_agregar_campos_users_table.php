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
        Schema::table('users', function (Blueprint $table) {
            //

            $table->string('apellido_paterno', 100)->default('');
            $table->string('apellido_materno', 100)->default('');
            $table->string('sexo', 100)->default('');
            $table->string('estado_civil', 100)->default('');
            $table->string('nacionalidad', 100)->default('');
            $table->string('rfc', 100)->default('');
            $table->string('curp', 100)->default('');
            $table->string('telefono', 100)->default(''); 
        });
    }

    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('apellido_paterno', 100);
            $table->dropColumn('apellido_materno', 100);
            $table->dropColumn('sexo', 100);
            $table->dropColumn('estado_civil', 100);
            $table->dropColumn('nacionalidad', 100);
            $table->dropColumn('rfc');
            $table->dropColumn('curp', 100);
            $table->dropColumn('telefono', 100);
        });
    }
};
