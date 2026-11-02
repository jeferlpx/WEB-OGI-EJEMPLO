@extends('layouts.admin')

@section('title', 'Editar Módulo: ' . $page->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Editar Módulo / Página: {{ $page->title }}</h1>
            <p class="text-xs text-[var(--text-muted)]">Actualice la configuración del menú, documentos oficiales PDF, enlaces o contenido bilingüe.</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ $page->url }}" target="{{ $page->target }}" class="btn-molinero-outline text-xs py-2 px-3 flex items-center gap-1.5" title="Ver en Portal Web">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span>Ver en Web</span>
            </a>
            <a href="{{ route('admin.pages.index') }}" class="btn-molinero-outline text-xs py-2 px-3 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Volver</span>
            </a>
        </div>
    </div>

    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- 1. TIPO DE MÓDULO Y UBICACIÓN -->
        <div class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                <span>1. Tipo de Módulo y Ubicación en el Menú</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Tipo de Módulo -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Tipo de Elemento *</label>
                    <select name="type" id="module_type" onchange="handleTypeChange(this.value)" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-semibold">
                        <option value="page" {{ old('type', $page->type ?? 'page') === 'page' ? 'selected' : '' }}>Página de Contenido Completa</option>
                        <option value="link" {{ old('type', $page->type ?? 'page') === 'link' ? 'selected' : '' }}>Enlace Directo o Archivo PDF</option>
                        <option value="button" {{ old('type', $page->type ?? 'page') === 'button' ? 'selected' : '' }}>Botón / Enlace Rápido</option>
                    </select>
                </div>

                <!-- Sección de Menú -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Sección de Menú Destino *</label>
                    <select name="nav_section" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-semibold">
                        @foreach($sections as $secKey => $secLabel)
                            <option value="{{ $secKey }}" {{ old('nav_section', $page->nav_section) === $secKey ? 'selected' : '' }}>
                                {{ $secLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Orden -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Orden / Posición</label>
                    <input type="number" name="order" value="{{ old('order', $page->order) }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    <span class="text-[10px] text-[var(--text-muted)]">N° menor aparece primero (1, 2, 3...).</span>
                </div>
            </div>

            <!-- Título Español e Inglés -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Título del Módulo / Enlace (Español) *</label>
                    <input type="text" name="title" id="page_title" value="{{ old('title', $page->title) }}" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-[var(--text-secondary)]">Título en Inglés</label>
                        <button type="button" onclick="autoTranslateField('page_title', 'title_en_input', 'title')" class="text-[10px] text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1 font-semibold">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                            Auto-Traducir
                        </button>
                    </div>
                    <input type="text" name="title_en" id="title_en_input" value="{{ old('title_en', $page->title_en) }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
            </div>

            <!-- Badge / Etiqueta y Slug -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Etiqueta Destacada / Badge</label>
                    <input type="text" name="badge" value="{{ old('badge', $page->badge) }}" placeholder="Ej: PDF, Nuevo, 2026" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Badge en Inglés</label>
                    <input type="text" name="badge_en" value="{{ old('badge_en', $page->badge_en) }}" placeholder="Ej: PDF, New, 2026" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Slug URL</label>
                    <input type="text" name="slug" id="page_slug" value="{{ old('slug', $page->slug) }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono text-[11px]" />
                </div>
            </div>
        </div>

        <!-- 2. DESTINO: ARCHIVO PDF O ENLACE EXTERNO -->
        <div class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                <span>2. Archivo PDF / Documento o Enlace URL</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Subir Nuevo Archivo PDF / Documento</label>
                    <input type="file" name="document_file" accept=".pdf,.doc,.docx,.zip,.xls,.xlsx" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[11px] file:bg-emerald-100 file:text-[#0F5132]" />
                    @if($page->file_path)
                        <div class="mt-2 flex items-center justify-between p-2 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-xs">
                            <a href="{{ asset($page->file_path) }}" target="_blank" class="text-emerald-800 dark:text-emerald-300 font-bold hover:underline truncate max-w-xs flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                <span>{{ basename($page->file_path) }}</span>
                            </a>
                            <label class="flex items-center gap-1 text-[11px] text-red-600 cursor-pointer">
                                <input type="checkbox" name="remove_document_file" value="1" />
                                <span>Eliminar archivo</span>
                            </label>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">O Enlace URL Externo / Interno</label>
                    <input type="text" name="external_url" value="{{ old('external_url', $page->external_url) }}" placeholder="https://ejemplo.com o /movilidad/entrante" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    <span class="text-[10px] text-[var(--text-muted)]">URL si no desea subir un archivo ni usar la página interna.</span>
                </div>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="open_in_new_tab" id="open_in_new_tab" value="1" {{ old('open_in_new_tab', $page->open_in_new_tab) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0F5132] focus:ring-[#0F5132]" />
                <label for="open_in_new_tab" class="text-xs font-medium text-[var(--text-secondary)] cursor-pointer">
                    Abrir enlace o documento en una pestaña nueva (target="_blank")
                </label>
            </div>
        </div>

        <!-- 3. CONTENIDO COMPLETO (Si es tipo Página) -->
        <div id="content_section_wrapper" class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-600"></span>
                <span>3. Contenido y Fotografías (Para Páginas Completas)</span>
            </h2>

            <!-- Resumen -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Resumen / Extracto (Español)</label>
                    <textarea name="summary" id="summary_es" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ old('summary', $page->summary) }}</textarea>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-[var(--text-secondary)]">Resumen en Inglés</label>
                        <button type="button" onclick="autoTranslateField('summary_es', 'summary_en_input', 'summary')" class="text-[10px] text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1 font-semibold">
                            Auto-Traducir
                        </button>
                    </div>
                    <textarea name="summary_en" id="summary_en_input" rows="2" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ old('summary_en', $page->summary_en) }}</textarea>
                </div>
            </div>

            <!-- Cuerpo Principal -->
            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Cuerpo / Contenido Completo (Español)</label>
                <textarea name="content" id="content_es" rows="8" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono">{{ old('content', $page->content) }}</textarea>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-[var(--text-secondary)]">Cuerpo / Contenido Completo (Inglés)</label>
                    <button type="button" onclick="autoTranslateField('content_es', 'content_en_input', 'content')" class="text-[10px] text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1 font-semibold">
                        Auto-Traducir Contenido
                    </button>
                </div>
                <textarea name="content_en" id="content_en_input" rows="6" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono">{{ old('content_en', $page->content_en) }}</textarea>
            </div>

            <!-- Imágenes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Fotografía Principal / Logo</label>
                    @if($page->featured_image_path)
                        <div class="mb-2 flex items-center gap-3 p-2 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                            <img src="{{ asset($page->featured_image_path) }}" alt="Foto actual" class="w-12 h-12 rounded object-cover" />
                            <label class="flex items-center gap-1 text-[11px] text-red-600 cursor-pointer">
                                <input type="checkbox" name="remove_featured_image" value="1" />
                                <span>Quitar foto actual</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[11px] file:bg-emerald-100 file:text-[#0F5132]" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Imagen de Portada / Banner Superior (Opcional)</label>
                    @if($page->banner_image_path)
                        <div class="mb-2 flex items-center gap-3 p-2 rounded-lg bg-[var(--bg-page)] border border-[var(--border-color)]">
                            <img src="{{ asset($page->banner_image_path) }}" alt="Banner actual" class="w-20 h-10 rounded object-cover" />
                            <label class="flex items-center gap-1 text-[11px] text-red-600 cursor-pointer">
                                <input type="checkbox" name="remove_banner_image" value="1" />
                                <span>Quitar banner actual</span>
                            </label>
                        </div>
                    @endif
                    <input type="file" name="banner_image" accept="image/*" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[11px] file:bg-emerald-100 file:text-[#0F5132]" />
                </div>
            </div>
        </div>

        <!-- 4. VISIBILIDAD Y PUBLICACIÓN -->
        <div class="card-molinero p-6 space-y-4">
            <h2 class="text-sm font-bold text-[var(--text-primary)] border-b border-[var(--border-color)] pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-600"></span>
                <span>4. Visibilidad y Estado</span>
            </h2>

            <div class="flex flex-wrap items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_in_nav" value="1" {{ old('show_in_nav', $page->show_in_nav) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0F5132] focus:ring-[#0F5132]" />
                    <span class="text-xs font-semibold text-[var(--text-primary)]">Mostrar en el Menú Superior y Móvil</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0F5132] focus:ring-[#0F5132]" />
                    <span class="text-xs font-semibold text-[var(--text-primary)]">Publicado en la Web</span>
                </label>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.pages.index') }}" class="btn-molinero-outline text-xs py-2 px-4">Cancelar</a>
            <button type="submit" class="btn-molinero text-xs py-2.5 px-6 font-bold shadow-md">
                Actualizar Módulo / Página
            </button>
        </div>
    </form>
</div>

<script>
    function handleTypeChange(val) {
        const contentWrapper = document.getElementById('content_section_wrapper');
        if (contentWrapper) {
            if (val === 'link') {
                contentWrapper.classList.add('opacity-60');
            } else {
                contentWrapper.classList.remove('opacity-60');
            }
        }
    }

    async function autoTranslateField(sourceId, targetId, fieldType) {
        const sourceEl = document.getElementById(sourceId);
        const targetEl = document.getElementById(targetId);
        if (!sourceEl || !targetEl || !sourceEl.value.trim()) {
            alert('Por favor ingrese primero el texto en español.');
            return;
        }

        try {
            targetEl.placeholder = 'Traduciendo...';
            const response = await fetch("{{ route('admin.api.translate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    text: sourceEl.value,
                    field: fieldType
                })
            });
            const data = await response.json();
            if (data.translation) {
                targetEl.value = data.translation;
            }
        } catch (e) {
            console.error('Error auto-traducción:', e);
        }
    }
</script>
@endsection
