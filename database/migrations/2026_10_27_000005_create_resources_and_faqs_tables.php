<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->enum('category', ['reglamento', 'guia', 'formato', 'boletin', 'resolucion', 'otro'])->default('guia');
            $table->enum('target_audience', ['estudiantes_salientes', 'estudiantes_entrantes', 'docentes', 'general'])->default('general');
            $table->string('file_path');
            $table->integer('file_size_kb')->default(0);
            $table->string('file_ext', 10)->default('pdf');
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('download_count')->default(0);
            $table->enum('publication_status', ['publicado', 'archivado'])->default('publicado');
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['movilidad_saliente', 'movilidad_entrante', 'convenios', 'becas', 'general'])->default('general');
            $table->string('question');
            $table->string('question_en')->nullable();
            $table->text('answer');
            $table->text('answer_en')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('resources');
    }
};
