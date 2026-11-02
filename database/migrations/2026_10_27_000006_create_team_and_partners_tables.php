<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_title');
            $table->string('role_title_en')->nullable();
            $table->string('department')->nullable(); // Dirección, Movilidad, Convenios, etc.
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->text('bio_en')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('cv_file_path')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['agencia_cooperacion', 'red_internacional', 'red_nacional', 'embajada', 'asociacion_estudiantil'])->default('agencia_cooperacion');
            $table->string('logo_path');
            $table->string('website_url')->nullable();
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
        Schema::dropIfExists('team_members');
    }
};
