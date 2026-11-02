@extends('layouts.admin')

@section('title', 'Redactar Noticia')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.news.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
            ← Volver a noticias
        </a>
        <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Redactar Noticia o Comunicado</h1>
    </div>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="card-molinero p-6 space-y-6">
        @csrf

        <!-- Barra de Utilidades Bilingües y Auto-traducción con IA -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3.5 bg-emerald-50/70 dark:bg-emerald-950/40 rounded-xl border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center gap-2.5">
                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-[#0F5132] text-white">Bilingüe ES / EN</span>
                <span class="text-xs text-[var(--text-secondary)] font-medium">Los campos en inglés se auto-traducirán automáticamente al guardar si se dejan vacíos.</span>
            </div>
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero text-xs flex items-center justify-center gap-2 py-2 px-3.5 shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>✨ Auto-traducir a Inglés con IA</span>
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Título Español -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Título de la Noticia (Español) *</label>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">🇪🇸 Principal</span>
                </div>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Ej: Histórico convenio entre la UNALM y la Universidad de Bolonia..." />
            </div>

            <!-- Título Inglés -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Título en Inglés (News Title in English)</label>
                    <span class="text-[10px] text-sky-700 dark:text-sky-400 font-semibold">🇬🇧 Versión Internacional</span>
                </div>
                <input type="text" name="title_en" value="{{ old('title_en') }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Opcional: Si se deja vacío, el sistema lo traducirá automáticamente..." />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Categoría *</label>
                <select name="category" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="institucional">Institucional</option>
                    <option value="convenio">Convenios y Acuerdos</option>
                    <option value="movilidad">Movilidad Estudiantil</option>
                    <option value="cooperacion">Cooperación Científica</option>
                    <option value="delegacion">Visita de Delegaciones</option>
                    <option value="evento">Eventos y Webinars</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Fecha de Publicación *</label>
                <input type="date" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de Publicación *</label>
                <select name="publication_status" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="publicado">Publicado</option>
                    <option value="borrador">Borrador</option>
                    <option value="en_revision">En Revisión</option>
                    <option value="archivado">Archivado</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Autor / Fuente</label>
                <input type="text" name="author_name" value="{{ old('author_name', 'Oficina de Gestión Interinstitucional') }}" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <!-- Resumen Español -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Resumen de la Noticia (Español) *</label>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">🇪🇸 Breve síntesis</span>
                </div>
                <textarea name="summary" rows="2" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Resumen conciso para las tarjetas del portal...">{{ old('summary') }}</textarea>
            </div>

            <!-- Resumen Inglés -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Resumen en Inglés (English Summary)</label>
                    <span class="text-[10px] text-sky-700 dark:text-sky-400 font-semibold">🇬🇧 Auto-traducible</span>
                </div>
                <textarea name="summary_en" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Opcional: Si se deja vacío, el sistema lo traducirá automáticamente...">{{ old('summary_en') }}</textarea>
            </div>

            <!-- Contenido Español -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Cuerpo Completo del Artículo (HTML/Texto) (Español) *</label>
                    <span class="text-[10px] text-emerald-700 dark:text-emerald-400 font-semibold">🇪🇸 Redacción completa</span>
                </div>
                <textarea name="content" rows="6" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Párrafos completos de la noticia...">{{ old('content') }}</textarea>
            </div>

            <!-- Contenido Inglés -->
            <div class="sm:col-span-2">
                <div class="flex items-center justify-between mb-1">
                    <label class="text-xs font-bold text-[var(--text-primary)]">Cuerpo Completo en Inglés (English Full Article Body)</label>
                    <span class="text-[10px] text-sky-700 dark:text-sky-400 font-semibold">🇬🇧 Auto-traducible</span>
                </div>
                <textarea name="content_en" rows="6" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" placeholder="Opcional: Si se deja vacío, el sistema lo traducirá automáticamente con IA conservando la estructura...">{{ old('content_en') }}</textarea>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Imagen Destacada (JPG, PNG, WebP máx. 5MB)</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#0F5132] file:text-white hover:file:bg-[#0A3622] cursor-pointer" />
            </div>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex items-center justify-between">
            <button type="button" onclick="autoTranslateForm(this)" class="btn-molinero-outline text-xs flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>Auto-traducir a Inglés</span>
            </button>
            <div class="flex gap-3">
                <a href="{{ route('admin.news.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
                <button type="submit" class="btn-molinero text-xs">Publicar Noticia</button>
            </div>
        </div>
    </form>
</div>
@endsection
