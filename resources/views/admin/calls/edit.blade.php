@extends('layouts.admin')

@section('title', 'Editar Convocatoria: ' . $call->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.calls.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
            ← Volver a convocatorias
        </a>
        <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Editar Convocatoria</h1>
    </div>

    <form action="{{ route('admin.calls.update', $call->id) }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Barra de Utilidades Bilingües y Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2.5">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe ES / EN</span>
                <span class="text-xs text-[var(--text-secondary)] font-medium">Si actualiza el texto en español y deja los campos en inglés vacíos, se auto-traducirán al guardar.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-2 py-2 px-3.5 shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés con IA</span>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Título de la Convocatoria (Español) *</label>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">🇪🇸 Principal</span>
                </div>
                <input type="text" name="title" value="{{ old('title', $call->title) }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Título en Inglés (Call Title in English)</label>
                    <span class="text-[10px] text-sky-700 dark:text-sky-400 font-semibold">🇬🇧 Versión Internacional</span>
                </div>
                <input type="text" name="title_en" value="{{ old('title_en', $call->title_en) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Auto-traducible si se deja vacío..." />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Tipo de Programa *</label>
                <select name="call_type" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="beca" {{ old('call_type', $call->call_type) === 'beca' ? 'selected' : '' }}>Beca de Movilidad</option>
                    <option value="movilidad" {{ old('call_type', $call->call_type) === 'movilidad' ? 'selected' : '' }}>Intercambio Semestral</option>
                    <option value="pasantia" {{ old('call_type', $call->call_type) === 'pasantia' ? 'selected' : '' }}>Pasantía Internacional</option>
                    <option value="investigacion" {{ old('call_type', $call->call_type) === 'investigacion' ? 'selected' : '' }}>Estancia de Investigación</option>
                    <option value="curso_corto" {{ old('call_type', $call->call_type) === 'curso_corto' ? 'selected' : '' }}>Curso Corto / Summer Camp</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Público Destinatario *</label>
                <select name="target_audience" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="estudiantes_pregrado" {{ old('target_audience', $call->target_audience) === 'estudiantes_pregrado' ? 'selected' : '' }}>Estudiantes de Pregrado</option>
                    <option value="estudiantes_posgrado" {{ old('target_audience', $call->target_audience) === 'estudiantes_posgrado' ? 'selected' : '' }}>Estudiantes de Posgrado</option>
                    <option value="docentes" {{ old('target_audience', $call->target_audience) === 'docentes' ? 'selected' : '' }}>Docentes e Investigadores</option>
                    <option value="administrativos" {{ old('target_audience', $call->target_audience) === 'administrativos' ? 'selected' : '' }}>Personal Administrativo</option>
                    <option value="todos" {{ old('target_audience', $call->target_audience) === 'todos' ? 'selected' : '' }}>Toda la Comunidad UNALM</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha de Inicio / Apertura</label>
                <input type="date" name="start_date" value="{{ old('start_date', $call->start_date?->format('Y-m-d')) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha Límite de Postulación (Cierre)</label>
                <input type="date" name="deadline_date" value="{{ old('deadline_date', $call->deadline_date?->format('Y-m-d')) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de Convocatoria *</label>
                <select name="status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="abierta" {{ old('status', $call->status) === 'abierta' ? 'selected' : '' }}>Abierta</option>
                    <option value="proxima" {{ old('status', $call->status) === 'proxima' ? 'selected' : '' }}>Próxima</option>
                    <option value="cerrada" {{ old('status', $call->status) === 'cerrada' ? 'selected' : '' }}>Cerrada</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado Editorial *</label>
                <select name="publication_status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="publicado" {{ old('publication_status', $call->publication_status) === 'publicado' ? 'selected' : '' }}>Publicado</option>
                    <option value="borrador" {{ old('publication_status', $call->publication_status) === 'borrador' ? 'selected' : '' }}>Borrador</option>
                    <option value="en_revision" {{ old('publication_status', $call->publication_status) === 'en_revision' ? 'selected' : '' }}>En Revisión</option>
                    <option value="archivado" {{ old('publication_status', $call->publication_status) === 'archivado' ? 'selected' : '' }}>Archivado</option>
                </select>
            </div>

            <!-- Resumen Español -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Resumen Breve (Español) *</label>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">🇪🇸 Principal</span>
                </div>
                <textarea name="summary" rows="2" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('summary', $call->summary) }}</textarea>
            </div>

            <!-- Resumen Inglés -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Resumen en Inglés (Call Summary in English)</label>
                    <span class="text-[10px] text-sky-700 dark:text-sky-400 font-semibold">🇬🇧 Auto-traducible</span>
                </div>
                <textarea name="summary_en" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Auto-traducible si se deja vacío...">{{ old('summary_en', $call->summary_en) }}</textarea>
            </div>

            <!-- Descripción Español -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Descripción Detallada (Español) *</label>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">🇪🇸 Principal</span>
                </div>
                <textarea name="description" rows="5" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('description', $call->description) }}</textarea>
            </div>

            <!-- Descripción Inglés -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Descripción Detallada en Inglés (Call Description in English)</label>
                    <span class="text-[10px] text-sky-700 dark:text-sky-400 font-semibold">🇬🇧 Auto-traducible</span>
                </div>
                <textarea name="description_en" rows="5" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Auto-traducible con IA conservando la estructura...">{{ old('description_en', $call->description_en) }}</textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Requisitos de Postulación</label>
                <textarea name="requirements" rows="3" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('requirements', $call->requirements) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Enlace a Portal Externo</label>
                <input type="url" name="apply_url" value="{{ old('apply_url', $call->apply_url) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Correo de Contacto</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $call->contact_email) }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div class="sm:col-span-2 space-y-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)]">Bases Oficiales de la Convocatoria (PDF)</label>
                @if($call->requirements_file_path)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50 dark:bg-emerald-950/30 rounded-lg border border-emerald-200 dark:border-emerald-800">
                    <div class="flex items-center gap-2">
                        <span class="text-base">📄</span>
                        <div>
                            <a href="{{ asset($call->requirements_file_path) }}" target="_blank" class="text-xs font-bold text-emerald-800 dark:text-emerald-300 underline hover:text-emerald-900">
                                Ver bases en PDF registrado
                            </a>
                            <span class="font-mono text-[10px] text-[var(--text-muted)] block truncate max-w-sm">{{ $call->requirements_file_path }}</span>
                        </div>
                    </div>
                    <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 px-2.5 py-1 rounded-md border border-rose-200 dark:border-rose-900/50">
                        <input type="checkbox" name="remove_file" value="1" class="rounded border-rose-300 text-rose-600 focus:ring-rose-500">
                        <span>🗑️ Quitar / Eliminar archivo de bases</span>
                    </label>
                </div>
                @else
                <p class="text-xs text-[var(--text-muted)] italic p-2 bg-gray-50 dark:bg-emerald-950/20 rounded border border-[var(--border-color)]">
                    Actualmente esta convocatoria no cuenta con archivo PDF de bases adjunto.
                </p>
                @endif
                <div>
                    <label class="block text-[11px] font-semibold text-[var(--text-secondary)] mb-1">Subir nuevo archivo PDF (o sustituir el actual):</label>
                    <input type="file" name="file" accept="application/pdf" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0F5132] file:text-white hover:file:bg-[#0A3622] cursor-pointer" />
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex items-center justify-between">
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero-outline text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>Auto-traducir a Inglés</span>
            </button>
            <div class="flex gap-3">
                <a href="{{ route('admin.calls.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
                <button type="submit" class="btn-molinero text-xs">Guardar Cambios</button>
            </div>
        </div>
    </form>
</div>
@endsection
