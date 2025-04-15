<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archivos_trabajo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trabajo_id')->constrained('trabajos')->onDelete('cascade');
            $table->text('ruta_archivo'); // Puedes renombrar a ruta_archivo si prefieres
            $table->enum('tipo_archivo', ['imagen', 'video', 'documento'])->default('imagen');
            $table->string('tipo_de_golpe')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamp('fecha_subida')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archivos_trabajo');
    }
};

