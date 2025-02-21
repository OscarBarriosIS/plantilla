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
        Schema::table('sepomexes', function (Blueprint $table) {
            $table->string('zap')->nullable()->default(NULL);
            $table->string('zae')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sepomexes', function (Blueprint $table) {
            $table->dropColumn(['zap', 'zae']);
        });
    }
};
