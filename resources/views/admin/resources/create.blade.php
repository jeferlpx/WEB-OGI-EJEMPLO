@extends('layouts.admin')

@section('title', 'Subir Nuevo Documento')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.resources.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
            ← Volver a biblioteca de documentos
        </a>
        <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Subir Documento Oficial</h1>
    </div>

    <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-5">
        @csrf

        <!-- Barra de Utilidades Bilingües y Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe</span>
                <span class="text-xs text-[var(--text-secondary)]">Los textos en inglés se auto-traducen si se dejan vacíos.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-1.5 py-1.5 px-3 shadow-sm whitespace-nowrap">
                <svg class="w-3.5 h-3.5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés</span>
            </button>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título del Documento (Español) *</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Título en Inglés (Document Title in English)</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Opcional: Se auto-traduce al guardar..." />
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Categoría *</label>
                    <select name="category" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                        <option value="guia">Guía / Instructivo</option>
                        <option value="reglamento">Reglamento / Directiva</option>
                        <option value="formato">Formato / Ficha de Solicitud</option>
                        <option value="boletin">Boletín Molinero</option>
                        <option value="resolucion">Resolución Rectoral</option>
                        <option value="otro">Otro Documento</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Público Destinatario *</label>
                    <select name="target_audience" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                        <option value="general">Público General</option>
                        <option value="estudiantes_salientes">Estudiantes UNALM (Salientes)</option>
                        <option value="estudiantes_entrantes">Estudiantes Internacionales (Entrantes)</option>
                        <option value="docentes">Docentes e Investigadores</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Descripción Breve del Documento (Español)</label>
                <textarea name="description" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Descripción en Inglés (Description in English)</label>
                <textarea name="description_en" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Opcional: Se auto-traduce al guardar...">{{ old('description_en') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Seleccionar Archivo (PDF, DOCX, XLSX máx. 30MB) *</label>
                <input type="file" name="file" required class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0F5132] file:text-white hover:file:bg-[#0A3622] cursor-pointer" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de Publicación *</label>
                <select name="publication_status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="publicado">Publicado (Visible)</option>
                    <option value="archivado">Archivado</option>
                </select>
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex items-center justify-between">
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero-outline text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>Auto-traducir</span>
            </button>
            <div class="flex gap-3">
                <a href="{{ route('admin.resources.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
                <button type="submit" class="btn-molinero text-xs">Subir Documento</button>
            </div>
        </div>
    </form>
</div>
@endsection
