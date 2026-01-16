<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('solicitud_archivos', function (Blueprint $table) {
            $table->id();

            // Esta es la columna que faltaba y causaba el error
            // Asume que tu tabla principal se llama 'solicituds' (según tu modelo anterior)
            $table->foreignId('solicitud_id')->constrained('solicituds')->onDelete('cascade');

            // Estas columnas también faltaban según tu resultado
            $table->string('file_path');
            $table->string('original_name')->nullable();
            $table->string('mime_type')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitud_archivos');
    }
};
