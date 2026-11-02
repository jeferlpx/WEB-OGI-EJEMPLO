<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code', 3)->nullable(); // PE, US, ES, DE...
            $table->string('flag_emoji', 10)->nullable();
            $table->string('region')->default('América del Sur'); // Europa, Asia, América del Norte, etc.
            $table->timestamps();
        });

        Schema::create('agreement_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Convenio Marco, Convenio Específico, Acuerdo de Movilidad, etc.
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('acronym')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('city')->nullable();
            $table->string('website_url')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('type')->default('universidad'); // universidad, centro_investigacion, gobierno, empresa
            $table->timestamps();
        });

        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(); // e.g. CI-001-2021
            $table->string('title');
            $table->foreignId('institution_id')->constrained('institutions')->onDelete('cascade');
            $table->foreignId('agreement_type_id')->constrained('agreement_types')->onDelete('cascade');
            $table->enum('scope', ['nacional', 'internacional'])->default('internacional');
            $table->string('faculty_scope')->default('Todas las facultades'); // o 'Facultad de Agronomía', etc.
            $table->text('objective')->nullable();
            $table->date('signed_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->boolean('is_indefinite')->default(false);
            $table->enum('status', ['vigente', 'por_vencer', 'vencido', 'en_renovacion'])->default('vigente');
            $table->enum('publication_status', ['borrador', 'en_revision', 'aprobado', 'publicado', 'archivado'])->default('publicado');
            $table->string('file_path')->nullable(); // PDF asociado
            $table->string('external_url')->nullable(); // enlace a Secretaría General o institucional
            $table->text('internal_notes')->nullable(); // notas privadas solo visibles en la intranet
            $table->string('contact_unit')->nullable(); // unidad o docente responsable
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agreements');
        Schema::dropIfExists('institutions');
        Schema::dropIfExists('agreement_types');
        Schema::dropIfExists('countries');
    }
};
