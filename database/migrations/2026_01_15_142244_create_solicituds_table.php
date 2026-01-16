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
        Schema::create('solicituds', function (Blueprint $table) {
            $table->id();
            $table->string('user_rut');

            $table->string('tipo');
            $table->string('departamento');
            $table->text('descripcion')->nullable();

            $table->string('estado')->default('Pendiente');

            $table->timestamps();

            $table->foreign('user_rut')->references('rut')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
