@extends('layouts.admin')

@section('title', 'Registrar Nuevo Convenio')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.agreements.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
                ← Volver al listado de convenios
            </a>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Registrar Nuevo Convenio</h1>
        </div>
    </div>

    <form action="{{ route('admin.agreements.store') }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título Oficial del Convenio *</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Código de Convenio (Ej. CI-075-UNALM)</label>
                <input type="text" name="code" value="{{ old('code') }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Ámbito *</label>
                <select name="scope" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="internacional" {{ old('scope') === 'internacional' ? 'selected' : '' }}>Internacional</option>
                    <option value="nacional" {{ old('scope') === 'nacional' ? 'selected' : '' }}>Nacional</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Institución Contraparte *</label>
                <select name="institution_id" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">Seleccione una institución...</option>
                    @foreach($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ old('institution_id') == $inst->id ? 'selected' : '' }}>{{ $inst->name }} ({{ $inst->country->name }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Tipo de Convenio *</label>
                <select name="agreement_type_id" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">Seleccione un tipo...</option>
                    @foreach($types as $t)
                    <option value="{{ $t->id }}" {{ old('agreement_type_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha de Firma / Inicio</label>
                <input type="date" name="signed_at" value="{{ old('signed_at') }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha de Vencimiento (dejar vacío si es indefinido)</label>
                <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de Vigencia *</label>
                <select name="status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="vigente" {{ old('status') === 'vigente' ? 'selected' : '' }}>Vigente</option>
                    <option value="por_vencer" {{ old('status') === 'por_vencer' ? 'selected' : '' }}>Por Vencer (&lt; 90 días)</option>
                    <option value="vencido" {{ old('status') === 'vencido' ? 'selected' : '' }}>Vencido</option>
                    <option value="en_renovacion" {{ old('status') === 'en_renovacion' ? 'selected' : '' }}>En Renovación</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado Editorial de Publicación *</label>
                <select name="publication_status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="publicado" {{ old('publication_status', 'publicado') === 'publicado' ? 'selected' : '' }}>Publicado (Visible en el portal)</option>
                    <option value="borrador" {{ old('publication_status') === 'borrador' ? 'selected' : '' }}>Borrador (Solo visible en intranet)</option>
                    <option value="en_revision" {{ old('publication_status') === 'en_revision' ? 'selected' : '' }}>En Revisión</option>
                    <option value="archivado" {{ old('publication_status') === 'archivado' ? 'selected' : '' }}>Archivado</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Objeto o Alcance del Convenio</label>
                <textarea name="objective" rows="3" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('objective') }}</textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Adjuntar Documento Oficial Escaneado (PDF, máx. 20MB)</label>
                <input type="file" name="file" accept="application/pdf" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0F5132] file:text-white hover:file:bg-[#0A3622] cursor-pointer" />
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Notas Internas de Gestión (Solo visibles para administradores OGI)</label>
                <textarea name="internal_notes" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Observaciones de la Comisión, fechas de informe semestral, resoluciones rectorales...">{{ old('internal_notes') }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex justify-end gap-3">
            <a href="{{ route('admin.agreements.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-molinero text-xs">Guardar y Registrar Convenio</button>
        </div>
    </form>
</div>
@endsection
