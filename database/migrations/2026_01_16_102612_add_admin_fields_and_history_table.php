<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Modificar tabla Users
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user'); // 'admin' o 'user'
            $table->boolean('is_active')->default(true); // Para suspender cuentas
        });

        // 2. Crear tabla Historial
        Schema::create('solicitud_historials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained(); // Quien hizo el cambio
            $table->string('accion'); // Ej: "Archivo Reemplazado"
            $table->string('archivo_anterior')->nullable();
            $table->string('archivo_nuevo')->nullable();
            $table->text('motivo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitud_historials');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'is_active']);
        });
    }
};
