@extends('layouts.admin')

@section('title', 'Editar Convenio: ' . $agreement->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.agreements.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
                ← Volver al listado de convenios
            </a>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Editar Convenio</h1>
        </div>
    </div>

    <form action="{{ route('admin.agreements.update', $agreement->id) }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título Oficial del Convenio *</label>
                <input type="text" name="title" value="{{ old('title', $agreement->title) }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Código de Convenio</label>
                <input type="text" name="code" value="{{ old('code', $agreement->code) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Ámbito *</label>
                <select name="scope" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="internacional" {{ old('scope', $agreement->scope) === 'internacional' ? 'selected' : '' }}>Internacional</option>
                    <option value="nacional" {{ old('scope', $agreement->scope) === 'nacional' ? 'selected' : '' }}>Nacional</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Institución Contraparte *</label>
                <select name="institution_id" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    @foreach($institutions as $inst)
                    <option value="{{ $inst->id }}" {{ old('institution_id', $agreement->institution_id) == $inst->id ? 'selected' : '' }}>{{ $inst->name }} ({{ $inst->country->name }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Tipo de Convenio *</label>
                <select name="agreement_type_id" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    @foreach($types as $t)
                    <option value="{{ $t->id }}" {{ old('agreement_type_id', $agreement->agreement_type_id) == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha de Firma / Inicio</label>
                <input type="date" name="signed_at" value="{{ old('signed_at', $agreement->signed_at?->format('Y-m-d')) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha de Vencimiento</label>
                <input type="date" name="expires_at" value="{{ old('expires_at', $agreement->expires_at?->format('Y-m-d')) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de Vigencia *</label>
                <select name="status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="vigente" {{ old('status', $agreement->status) === 'vigente' ? 'selected' : '' }}>Vigente</option>
                    <option value="por_vencer" {{ old('status', $agreement->status) === 'por_vencer' ? 'selected' : '' }}>Por Vencer</option>
                    <option value="vencido" {{ old('status', $agreement->status) === 'vencido' ? 'selected' : '' }}>Vencido</option>
                    <option value="en_renovacion" {{ old('status', $agreement->status) === 'en_renovacion' ? 'selected' : '' }}>En Renovación</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de Publicación *</label>
                <select name="publication_status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="publicado" {{ old('publication_status', $agreement->publication_status) === 'publicado' ? 'selected' : '' }}>Publicado (Visible)</option>
                    <option value="borrador" {{ old('publication_status', $agreement->publication_status) === 'borrador' ? 'selected' : '' }}>Borrador (Oculto)</option>
                    <option value="en_revision" {{ old('publication_status', $agreement->publication_status) === 'en_revision' ? 'selected' : '' }}>En Revisión</option>
                    <option value="archivado" {{ old('publication_status', $agreement->publication_status) === 'archivado' ? 'selected' : '' }}>Archivado</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Objeto o Alcance del Convenio</label>
                <textarea name="objective" rows="3" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('objective', $agreement->objective) }}</textarea>
            </div>

            <div class="sm:col-span-2 space-y-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)]">Documento Oficial del Convenio (PDF)</label>
                @if($agreement->file_path)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50 dark:bg-emerald-950/30 rounded-lg border border-emerald-200 dark:border-emerald-800">
                    <div class="flex items-center gap-2">
                        <span class="text-base">📄</span>
                        <div>
                            <a href="{{ asset($agreement->file_path) }}" target="_blank" class="text-xs font-bold text-emerald-800 dark:text-emerald-300 underline hover:text-emerald-900">
                                Ver documento PDF registrado
                            </a>
                            <span class="font-mono text-[10px] text-[var(--text-muted)] block truncate max-w-sm">{{ $agreement->file_path }}</span>
                        </div>
                    </div>
                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 px-2.5 py-1 rounded-md border border-rose-200 dark:border-rose-900/50">
                        <input type="checkbox" name="remove_file" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                        <span>🗑️ Quitar / Eliminar archivo PDF adjunto</span>
                    </label>
                </div>
                @else
                <p class="text-xs text-[var(--text-muted)] italic p-2 bg-gray-50 dark:bg-emerald-950/20 rounded border border-[var(--border-color)]">
                    Actualmente este convenio no cuenta con archivo PDF adjunto.
                </p>
                @endif
                <div>
                    <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Subir nuevo archivo PDF (o sustituir el actual):</label>
                    <input type="file" name="file" accept="application/pdf" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0F5132] file:text-white hover:file:bg-[#0A3622] cursor-pointer" />
                </div>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Notas Internas de Gestión</label>
                <textarea name="internal_notes" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('internal_notes', $agreement->internal_notes) }}</textarea>
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex justify-end gap-3">
            <a href="{{ route('admin.agreements.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-molinero text-xs">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
