<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->enum('category', ['convenio', 'movilidad', 'cooperacion', 'institucional', 'delegacion', 'evento'])->default('institucional');
            $table->date('published_at');
            $table->string('featured_image_path')->nullable();
            $table->text('summary')->nullable();
            $table->text('summary_en')->nullable();
            $table->longText('content')->nullable();
            $table->longText('content_en')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('publication_status', ['borrador', 'en_revision', 'aprobado', 'publicado', 'archivado'])->default('publicado');
            $table->string('author_name')->default('Oficina de Gestión Interinstitucional');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
