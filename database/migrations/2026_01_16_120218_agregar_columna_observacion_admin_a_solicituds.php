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
        Schema::table('solicituds', function (Blueprint $table) {
            // Verificamos si la columna no existe antes de crearla para evitar errores
            if (!Schema::hasColumn('solicituds', 'observacion_admin')) {
                $table->text('observacion_admin')->nullable()->after('estado');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            if (Schema::hasColumn('solicituds', 'observacion_admin')) {
                $table->dropColumn('observacion_admin');
            }
        });
    }
};
