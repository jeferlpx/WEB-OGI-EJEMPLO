<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->enum('call_type', ['beca', 'movilidad', 'pasantia', 'investigacion', 'curso_corto'])->default('beca');
            $table->enum('target_audience', ['estudiantes_pregrado', 'estudiantes_posgrado', 'docentes', 'administrativos', 'todos'])->default('estudiantes_pregrado');
            $table->date('start_date')->nullable();
            $table->date('deadline_date')->nullable();
            $table->enum('status', ['abierta', 'proxima', 'cerrada'])->default('abierta');
            $table->enum('publication_status', ['borrador', 'en_revision', 'aprobado', 'publicado', 'archivado'])->default('publicado');
            $table->text('summary')->nullable();
            $table->text('summary_en')->nullable();
            $table->longText('description')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('requirements_file_path')->nullable(); // PDF de bases
            $table->string('apply_url')->nullable(); // Enlace a formulario o plataforma externa
            $table->string('contact_email')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('banner_image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
