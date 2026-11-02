@extends('layouts.admin')

@section('title', 'Biblioteca de Medios y Documentos')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Biblioteca de Medios y Documentos</h1>
            <p class="text-xs text-[var(--text-muted)]">Subida, clasificación y custodia de documentos oficiales (PDFs, guías y boletines).</p>
        </div>

        <a href="{{ route('admin.resources.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Subir Nuevo Documento</span>
        </a>
    </div>

    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Documento</th>
                        <th class="py-3 px-4">Categoría</th>
                        <th class="py-3 px-4">Público</th>
                        <th class="py-3 px-4">Formato / Peso</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($resources as $res)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4">
                            <span class="font-bold text-[var(--text-primary)] block">{{ $res->title }}</span>
                            <span class="text-[11px] text-[var(--text-muted)] truncate block max-w-sm">{{ $res->description }}</span>
                        </td>
                        <td class="py-3 px-4 uppercase text-[10px] font-semibold">{{ $res->category }}</td>
                        <td class="py-3 px-4">{{ ucfirst(str_replace('_', ' ', $res->target_audience)) }}</td>
                        <td class="py-3 px-4">
                            <span class="font-mono text-emerald-700 dark:text-emerald-400 font-bold uppercase">{{ $res->file_ext }}</span>
                            <span class="text-[11px] text-[var(--text-muted)]">({{ $res->file_size_kb }} KB)</span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ asset($res->file_path) }}" target="_blank" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">Ver</a>
                            <form action="{{ route('admin.resources.destroy', $res->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar este documento del repositorio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-xs text-[var(--text-muted)]">No hay documentos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $resources->links() }}
        </div>
    </div>
</div>
@endsection
