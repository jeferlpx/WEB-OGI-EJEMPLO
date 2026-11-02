@extends('layouts.admin')

@section('title', 'Gestión de Convocatorias y Becas')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Convocatorias y Becas</h1>
            <p class="text-xs text-[var(--text-muted)]">Administre los programas de becas, pasantías y oportunidades internacionales.</p>
        </div>

        <a href="{{ route('admin.calls.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Nueva Convocatoria</span>
        </a>
    </div>

    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Título</th>
                        <th class="py-3 px-4">Tipo</th>
                        <th class="py-3 px-4">Público</th>
                        <th class="py-3 px-4">Cierre</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($calls as $call)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4 font-bold text-[var(--text-primary)] max-w-xs truncate">{{ $call->title }}</td>
                        <td class="py-3 px-4 uppercase text-[10px] font-semibold">{{ $call->call_type }}</td>
                        <td class="py-3 px-4">{{ ucfirst(str_replace('_', ' ', $call->target_audience)) }}</td>
                        <td class="py-3 px-4">{{ $call->deadline_date ? $call->deadline_date->format('d/m/Y') : 'Abierta' }}</td>
                        <td class="py-3 px-4">
                            <span class="badge-status badge-{{ $call->status === 'abierta' ? 'vigente' : 'vencido' }}">
                                {{ ucfirst($call->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ route('admin.calls.edit', $call->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">Editar</a>
                            <form action="{{ route('admin.calls.destroy', $call->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta convocatoria?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-xs text-[var(--text-muted)]">No hay convocatorias registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $calls->links() }}
        </div>
    </div>
</div>
@endsection
