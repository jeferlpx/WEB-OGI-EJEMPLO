@extends('layouts.admin')

@section('title', 'Gestión de Noticias y Eventos')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Noticias y Eventos</h1>
            <p class="text-xs text-[var(--text-muted)]">Sala de prensa, visitas protocolares y comunicados oficiales de la OGI.</p>
        </div>

        <a href="{{ route('admin.news.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Redactar Noticia</span>
        </a>
    </div>

    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Título</th>
                        <th class="py-3 px-4">Categoría</th>
                        <th class="py-3 px-4">Fecha</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($news as $article)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4 font-bold text-[var(--text-primary)] max-w-xs truncate">{{ $article->title }}</td>
                        <td class="py-3 px-4 uppercase text-[10px] font-semibold">{{ $article->category }}</td>
                        <td class="py-3 px-4">{{ $article->published_at->format('d/m/Y') }}</td>
                        <td class="py-3 px-4">
                            <span class="text-[11px] font-semibold uppercase {{ $article->publication_status === 'publicado' ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600' }}">
                                {{ $article->publication_status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ route('admin.news.edit', $article->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">Editar</a>
                            <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta noticia?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-xs text-[var(--text-muted)]">No hay noticias registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
