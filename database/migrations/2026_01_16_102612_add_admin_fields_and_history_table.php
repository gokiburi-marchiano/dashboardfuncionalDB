<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user');
            $table->boolean('is_active')->default(true);
        });

        Schema::create('solicitud_historials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained();
            $table->string('accion');
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
