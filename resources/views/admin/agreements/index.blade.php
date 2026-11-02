@extends('layouts.admin')

@section('title', 'Gestión de Convenios')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Gestión de Convenios</h1>
            <p class="text-xs text-[var(--text-muted)]">Directorio administrativo de convenios marco y específicos nacionales e internacionales.</p>
        </div>

        <a href="{{ route('admin.agreements.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Registrar Nuevo Convenio</span>
        </a>
    </div>

    <!-- Barra de Filtros -->
    <div class="card-molinero p-4">
        <form method="GET" action="{{ route('admin.agreements.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por código, título o institución..." class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div>
                <select name="scope" class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                    <option value="">Ámbito (Nacional / Int.)</option>
                    <option value="internacional" {{ request('scope') === 'internacional' ? 'selected' : '' }}>Internacional</option>
                    <option value="nacional" {{ request('scope') === 'nacional' ? 'selected' : '' }}>Nacional</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="btn-molinero text-xs py-2 px-4 w-full">Filtrar</button>
                @if(request()->hasAny(['q', 'scope', 'status']))
                <a href="{{ route('admin.agreements.index') }}" class="text-xs text-[var(--text-muted)] hover:underline whitespace-nowrap">Limpiar</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabla de Convenios -->
    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Código</th>
                        <th class="py-3 px-4">Institución / País</th>
                        <th class="py-3 px-4">Tipo</th>
                        <th class="py-3 px-4">Vigencia</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4">Publicación</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($agreements as $agr)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4 font-mono font-bold">{{ $agr->code ?: 'S/C' }}</td>
                        <td class="py-3 px-4">
                            <span class="font-bold text-[var(--text-primary)] block">{{ $agr->institution->name }}</span>
                            <span class="text-[11px] text-[var(--text-muted)]">{{ $agr->institution->country->name }} ({{ $agr->institution->country->flag_emoji }})</span>
                        </td>
                        <td class="py-3 px-4 text-[var(--text-secondary)]">{{ $agr->type->name }}</td>
                        <td class="py-3 px-4">
                            @if($agr->expires_at)
                                {{ $agr->expires_at->format('d/m/Y') }}
                            @else
                                <span class="text-emerald-700 dark:text-emerald-400 font-medium">Indefinido</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="badge-status badge-{{ $agr->status }}">
                                {{ ucfirst(str_replace('_', ' ', $agr->status)) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-[11px] font-semibold uppercase {{ $agr->publication_status === 'publicado' ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600' }}">
                                {{ $agr->publication_status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ route('admin.agreements.edit', $agr->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
                                Editar
                            </a>
                            <form action="{{ route('admin.agreements.destroy', $agr->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar este convenio? Esta acción registrará trazabilidad en auditoría.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-xs text-[var(--text-muted)]">
                            No se encontraron convenios registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $agreements->links() }}
        </div>
    </div>
</div>
@endsection
