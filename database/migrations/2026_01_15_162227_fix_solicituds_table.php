<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            if (!Schema::hasColumn('solicituds', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('cascade');
            }

            if (!Schema::hasColumn('solicituds', 'titulo')) {
                $table->string('titulo')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('solicituds', 'archivo_path')) {
                $table->string('archivo_path')->nullable()->after('descripcion');
            }
        });
    }

    public function down(): void
    {
        Schema::table('solicituds', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'titulo', 'archivo_path']);
        });
    }
};
