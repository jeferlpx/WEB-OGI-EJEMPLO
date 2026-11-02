@extends('layouts.admin')

@section('title', 'Crear Módulo, Enlace o Página')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Crear Módulo, Enlace o Página de Navegación</h1>
            <p class="text-xs text-[var(--text-muted)]">Configure nuevos módulos para Movilidad Entrante, Movilidad Saliente, Summer Camp, Convenios o Enlaces Rápidos con reflejo directo en la web.</p>
        </div>

        <a href="{{ route('admin.pages.index') }}" class="btn-molinero-outline text-xs py-2 px-3 flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Volver a la Lista</span>
        </a>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

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
                        <option value="page" {{ old('type', 'page') === 'page' ? 'selected' : '' }}>Página de Contenido Completa</option>
                        <option value="link" {{ old('type') === 'link' ? 'selected' : '' }}>Enlace Directo o Archivo PDF</option>
                        <option value="button" {{ old('type') === 'button' ? 'selected' : '' }}>Botón / Enlace Rápido</option>
                    </select>
                </div>

                <!-- Sección de Menú -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Sección de Menú Destino *</label>
                    <select name="nav_section" required class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-semibold">
                        @foreach($sections as $secKey => $secLabel)
                            <option value="{{ $secKey }}" {{ old('nav_section', 'movilidad_entrante') === $secKey ? 'selected' : '' }}>
                                {{ $secLabel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Orden -->
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Orden / Posición</label>
                    <input type="number" name="order" value="{{ old('order', $nextOrder) }}" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    <span class="text-[10px] text-[var(--text-muted)]">N° menor aparece primero (1, 2, 3...).</span>
                </div>
            </div>

            <!-- Título Español e Inglés -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Título del Módulo / Enlace (Español) *</label>
                    <input type="text" name="title" id="page_title" value="{{ old('title') }}" required placeholder="Ej: Guía de Trámites de Visa o Summer School" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" onkeyup="updateSlugPreview(this.value)" />
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-[var(--text-secondary)]">Título en Inglés</label>
                        <button type="button" onclick="autoTranslateField('page_title', 'title_en_input', 'title')" class="text-[10px] text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1 font-semibold">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                            Auto-Traducir
                        </button>
                    </div>
                    <input type="text" name="title_en" id="title_en_input" value="{{ old('title_en') }}" placeholder="Ej: Visa Procedures Guide or Summer School" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>
            </div>

            <!-- Badge / Etiqueta y Slug -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Etiqueta Destacada / Badge (Opcional)</label>
                    <input type="text" name="badge" value="{{ old('badge') }}" placeholder="Ej: PDF, Nuevo, 2026" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Badge en Inglés (Opcional)</label>
                    <input type="text" name="badge_en" value="{{ old('badge_en') }}" placeholder="Ej: PDF, New, 2026" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Slug URL (Opcional)</label>
                    <input type="text" name="slug" id="page_slug" value="{{ old('slug') }}" placeholder="autogenerado si está vacío" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono text-[11px]" />
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
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Subir Archivo PDF / Documento Oficial</label>
                    <input type="file" name="document_file" accept=".pdf,.doc,.docx,.zip,.xls,.xlsx" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[11px] file:bg-emerald-100 file:text-[#0F5132]" />
                    <span class="text-[10px] text-[var(--text-muted)]">Al subir un PDF, el menú abrirá directamente el documento. (Máx 30MB)</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">O Enlace URL Externo / Interno</label>
                    <input type="text" name="external_url" value="{{ old('external_url') }}" placeholder="https://ejemplo.com o /movilidad/entrante" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]" />
                    <span class="text-[10px] text-[var(--text-muted)]">URL si no desea subir un archivo ni usar la página interna.</span>
                </div>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <input type="checkbox" name="open_in_new_tab" id="open_in_new_tab" value="1" {{ old('open_in_new_tab', 1) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0F5132] focus:ring-[#0F5132]" />
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
                    <textarea name="summary" id="summary_es" rows="2" placeholder="Breve descripción del módulo..." class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ old('summary') }}</textarea>
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold text-[var(--text-secondary)]">Resumen en Inglés</label>
                        <button type="button" onclick="autoTranslateField('summary_es', 'summary_en_input', 'summary')" class="text-[10px] text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1 font-semibold">
                            Auto-Traducir
                        </button>
                    </div>
                    <textarea name="summary_en" id="summary_en_input" rows="2" placeholder="Brief summary..." class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">{{ old('summary_en') }}</textarea>
                </div>
            </div>

            <!-- Cuerpo Principal -->
            <div>
                <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Cuerpo / Contenido Completo (Español)</label>
                <textarea name="content" id="content_es" rows="8" placeholder="Escriba los párrafos, listas o estructura HTML del módulo..." class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono">{{ old('content') }}</textarea>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold text-[var(--text-secondary)]">Cuerpo / Contenido Completo (Inglés)</label>
                    <button type="button" onclick="autoTranslateField('content_es', 'content_en_input', 'content')" class="text-[10px] text-emerald-700 dark:text-emerald-400 hover:underline flex items-center gap-1 font-semibold">
                        Auto-Traducir Contenido
                    </button>
                </div>
                <textarea name="content_en" id="content_en_input" rows="6" placeholder="English content HTML or markdown..." class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-mono">{{ old('content_en') }}</textarea>
            </div>

            <!-- Imágenes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Fotografía Principal / Logo de Referencia</label>
                    <input type="file" name="featured_image" accept="image/*" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-[11px] file:bg-emerald-100 file:text-[#0F5132]" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-[var(--text-secondary)] mb-1">Imagen de Portada / Banner Superior (Opcional)</label>
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
                    <input type="checkbox" name="show_in_nav" value="1" {{ old('show_in_nav', 1) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0F5132] focus:ring-[#0F5132]" />
                    <span class="text-xs font-semibold text-[var(--text-primary)]">Mostrar en el Menú Superior y Móvil</span>
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', 1) ? 'checked' : '' }} class="rounded border-gray-300 text-[#0F5132] focus:ring-[#0F5132]" />
                    <span class="text-xs font-semibold text-[var(--text-primary)]">Publicar Inmediatamente en la Web</span>
                </label>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.pages.index') }}" class="btn-molinero-outline text-xs py-2 px-4">Cancelar</a>
            <button type="submit" class="btn-molinero text-xs py-2.5 px-6 font-bold shadow-md">
                Guardar Módulo / Página
            </button>
        </div>
    </form>
</div>

<script>
    function updateSlugPreview(title) {
        const slugInput = document.getElementById('page_slug');
        if (slugInput && !slugInput.dataset.manual) {
            slugInput.value = title.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');
        }
    }

    document.getElementById('page_slug')?.addEventListener('input', function() {
        this.dataset.manual = 'true';
    });

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
