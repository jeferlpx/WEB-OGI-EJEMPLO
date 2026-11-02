@extends('layouts.admin')

@section('title', 'Módulos, Páginas y Navegación')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Gestión de Módulos, Enlaces y Páginas de Navegación</h1>
            <p class="text-xs text-[var(--text-muted)]">Cree, modifique y ordene páginas, submenús, enlaces directos a PDFs y botones para Movilidad Entrante, Saliente, Summer Camp y Redes con reflejo dinámico en la web.</p>
        </div>

        <a href="{{ route('admin.pages.create') }}" class="btn-molinero text-xs py-2.5 px-4 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Crear Módulo o Enlace</span>
        </a>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="card-molinero p-4">
        <form method="GET" action="{{ route('admin.pages.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative flex-1 w-full">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por título, contenido, slug o archivo..." class="w-full text-xs px-3 py-2 pl-9 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:ring-2 focus:ring-[#0F5132]" />
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <div class="w-full sm:w-60">
                <select name="section" onchange="this.form.submit()" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] font-medium">
                    <option value="">Todas las Secciones del Menú</option>
                    @foreach($sections as $secKey => $secLabel)
                        <option value="{{ $secKey }}" {{ request('section') === $secKey ? 'selected' : '' }}>{{ $secLabel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full sm:w-44">
                <select name="type" onchange="this.form.submit()" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)]">
                    <option value="">Todos los Tipos</option>
                    <option value="page" {{ request('type') === 'page' ? 'selected' : '' }}>Página de Contenido</option>
                    <option value="link" {{ request('type') === 'link' ? 'selected' : '' }}>Enlace / Documento</option>
                    <option value="button" {{ request('type') === 'button' ? 'selected' : '' }}>Botón Destacado</option>
                </select>
            </div>

            @if(request()->anyFilled(['q', 'section', 'type']))
                <a href="{{ route('admin.pages.index') }}" class="btn-molinero-outline text-xs py-2 px-3 whitespace-nowrap">Limpiar</a>
            @endif
        </form>
    </div>

    <!-- Tabla de Páginas y Módulos -->
    <div class="card-molinero overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-secondary)] font-bold uppercase text-[10px] tracking-wider">
                        <th class="py-3 px-4">Módulo / Título</th>
                        <th class="py-3 px-4">Sección del Menú</th>
                        <th class="py-3 px-4">Destino / Archivo</th>
                        <th class="py-3 px-4 text-center">Tipo</th>
                        <th class="py-3 px-4 text-center">Menú Web</th>
                        <th class="py-3 px-4 text-center">Estado</th>
                        <th class="py-3 px-4 text-center">Orden</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($pages as $page)
                    <tr class="hover:bg-emerald-50/40 dark:hover:bg-emerald-950/20 transition-colors">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                @if($page->featured_image_path && file_exists(public_path($page->featured_image_path)))
                                    <img src="{{ asset($page->featured_image_path) }}" alt="{{ $page->title }}" class="w-10 h-10 rounded-lg object-cover border border-[var(--border-color)] flex-shrink-0" />
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-950/60 border border-[var(--border-color)] flex items-center justify-center text-[#0F5132] dark:text-emerald-400 font-bold flex-shrink-0">
                                        @if($page->type === 'link')
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                        @elseif($page->file_path)
                                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        @endif
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="flex items-center gap-1.5">
                                        <span class="font-bold text-[var(--text-primary)] truncate max-w-xs">{{ $page->title }}</span>
                                        @if($page->badge)
                                            <span class="px-1.5 py-0.2 rounded text-[9px] font-bold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">{{ $page->badge }}</span>
                                        @endif
                                    </div>
                                    <span class="block text-[10px] text-[var(--text-muted)] truncate max-w-xs">{{ $page->title_en ?: 'Traducción pendiente' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold {{ str_starts_with($page->nav_section, 'movilidad') || $page->nav_section === 'summer_camp' ? 'bg-emerald-100 text-[#0F5132] dark:bg-emerald-950 dark:text-emerald-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300' }}">
                                {{ $page->section_label }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            @if($page->file_path)
                                <a href="{{ asset($page->file_path) }}" target="_blank" class="inline-flex items-center gap-1 text-red-600 dark:text-red-400 font-semibold hover:underline">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                    <span class="truncate max-w-[150px]">{{ basename($page->file_path) }}</span>
                                </a>
                            @elseif($page->external_url)
                                <a href="{{ $page->external_url }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 hover:underline">
                                    <span class="truncate max-w-[150px]">{{ $page->external_url }}</span>
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @else
                                <a href="{{ route('pages.show', $page->slug) }}" target="_blank" class="inline-flex items-center gap-1 text-emerald-700 dark:text-emerald-400 hover:underline font-mono text-[11px]">
                                    <span>/pagina/{{ $page->slug }}</span>
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($page->type === 'link')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-950 dark:text-blue-300">Enlace</span>
                            @elseif($page->type === 'button')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-700 dark:bg-purple-950 dark:text-purple-300">Botón</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">Página</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($page->show_in_nav)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-300">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Visible
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400">
                                    Oculto
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($page->is_published)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                                    Publicado
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">
                                    Borrador
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center font-bold text-[var(--text-secondary)]">
                            {{ $page->order }}
                        </td>
                        <td class="py-3 px-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ $page->url }}" target="{{ $page->target }}" class="p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-800 text-[var(--text-muted)] hover:text-emerald-700" title="Ver en Portal">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>

                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="p-1.5 rounded hover:bg-gray-100 dark:hover:bg-gray-800 text-[var(--text-muted)] hover:text-blue-600" title="Editar Módulo">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>

                                <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar \'{{ $page->title }}\'? Esta acción no se puede deshacer.')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-950/40 text-[var(--text-muted)] hover:text-red-600" title="Eliminar Módulo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-[var(--text-muted)]">
                            No se encontraron módulos registrados con los filtros aplicados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
            <div class="p-4 border-t border-[var(--border-color)]">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
