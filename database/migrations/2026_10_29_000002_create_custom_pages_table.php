<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('slug')->unique();
            $table->string('nav_section')->default('redes_internacionales'); 
            // Posibles secciones: redes_internacionales, redes_nacionales, aliados, la_ogi, cooperacion, movilidad, general
            $table->text('summary')->nullable();
            $table->text('summary_en')->nullable();
            $table->longText('content');
            $table->longText('content_en')->nullable();
            $table->string('featured_image_path')->nullable();
            $table->string('banner_image_path')->nullable();
            $table->string('external_url')->nullable();
            $table->boolean('show_in_nav')->default(true);
            $table->boolean('is_published')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_pages');
    }
};

