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

            $table->foreignId('solicitud_id')->constrained('solicituds')->onDelete('cascade');

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
