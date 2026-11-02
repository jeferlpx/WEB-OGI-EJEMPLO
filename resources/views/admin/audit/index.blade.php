@extends('layouts.admin')

@section('title', 'Registro de Auditoría y Trazabilidad')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Trazabilidad y Auditoría Institucional</h1>
            <p class="text-xs text-[var(--text-muted)]">Registro inmutable de todas las acciones, publicaciones, ediciones y accesos en el sistema.</p>
        </div>
    </div>

    <!-- Barra de Filtro Rápido -->
    <div class="card-molinero p-4">
        <form method="GET" action="{{ route('admin.audit.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div class="sm:col-span-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por usuario, IP o detalle de la acción..." class="w-full text-xs px-3 py-2 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="btn-molinero text-xs py-2 px-4 w-full">Filtrar</button>
                @if(request()->filled('q'))
                <a href="{{ route('admin.audit.index') }}" class="text-xs text-[var(--text-muted)] hover:underline whitespace-nowrap">Limpiar</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tabla de Logs de Auditoría -->
    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Fecha y Hora</th>
                        <th class="py-3 px-4">Usuario</th>
                        <th class="py-3 px-4">Acción</th>
                        <th class="py-3 px-4">Entidad Afectada</th>
                        <th class="py-3 px-4">Detalles</th>
                        <th class="py-3 px-4">Dirección IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4 font-mono text-[var(--text-muted)] whitespace-nowrap">
                            {{ $log->created_at->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="py-3 px-4 font-bold text-[var(--text-primary)]">
                            {{ $log->user_name ?: 'Sistema' }}
                        </td>
                        <td class="py-3 px-4">
                            <span class="inline-block px-2 py-0.5 text-[10px] uppercase font-bold rounded-full 
                                @if($log->action === 'create') bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300
                                @elseif($log->action === 'update') bg-blue-100 text-blue-800 dark:bg-blue-950 dark:text-blue-300
                                @elseif($log->action === 'delete') bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300
                                @elseif($log->action === 'login') bg-purple-100 text-purple-800 dark:bg-purple-950 dark:text-purple-300
                                @else bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300 @endif">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="py-3 px-4 font-semibold text-[var(--text-secondary)]">
                            {{ $log->entity_type }} #{{ $log->entity_id }}
                        </td>
                        <td class="py-3 px-4 text-[var(--text-secondary)] max-w-xs truncate" title="{{ $log->details }}">
                            {{ $log->details ?: '-' }}
                        </td>
                        <td class="py-3 px-4 font-mono text-[11px] text-[var(--text-muted)]">
                            {{ $log->ip_address ?: '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-xs text-[var(--text-muted)]">
                            No se registran eventos de auditoría.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
