@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Encabezado de Bienvenida y Accesos Rápidos -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-[var(--text-primary)]">Panel de Control OGI</h1>
            <p class="text-xs text-[var(--text-muted)] mt-0.5">
                Bienvenido, <strong class="text-[var(--text-primary)]">{{ auth()->user()->name }}</strong>. Administre los convenios, convocatorias y publicaciones de la oficina.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.agreements.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Nuevo Convenio</span>
            </a>
            <a href="{{ route('admin.calls.create') }}" class="btn-molinero-outline text-xs py-2 px-3 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Nueva Convocatoria</span>
            </a>
        </div>
    </div>

    <!-- Tarjetas de Métricas Institucionales -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="card-molinero p-5 border-l-4 border-l-[#0F5132]">
            <span class="text-xs font-semibold text-[var(--text-muted)] block mb-1">Total Convenios</span>
            <span class="text-2xl font-extrabold text-[var(--text-primary)]">{{ $stats['total_agreements'] }}</span>
            <span class="text-[11px] text-emerald-600 dark:text-emerald-400 block mt-1">{{ $stats['active_agreements'] }} vigentes</span>
        </div>

        <div class="card-molinero p-5 border-l-4 border-l-amber-500">
            <span class="text-xs font-semibold text-[var(--text-muted)] block mb-1">Por Vencer (&lt; 90 d)</span>
            <span class="text-2xl font-extrabold text-amber-600 dark:text-amber-400">{{ $stats['expiring_agreements'] }}</span>
            <span class="text-[11px] text-[var(--text-muted)] block mt-1">Requieren revisión</span>
        </div>

        <div class="card-molinero p-5 border-l-4 border-l-blue-500">
            <span class="text-xs font-semibold text-[var(--text-muted)] block mb-1">Convocatorias Abiertas</span>
            <span class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">{{ $stats['open_calls'] }}</span>
            <span class="text-[11px] text-[var(--text-muted)] block mt-1">Becas activas</span>
        </div>

        <div class="card-molinero p-5 border-l-4 border-l-purple-500">
            <span class="text-xs font-semibold text-[var(--text-muted)] block mb-1">Noticias y Recursos</span>
            <span class="text-2xl font-extrabold text-purple-600 dark:text-purple-400">{{ $stats['total_news'] + $stats['total_resources'] }}</span>
            <span class="text-[11px] text-[var(--text-muted)] block mt-1">Artículos y documentos</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Últimos Convenios Registrados -->
        <div class="lg:col-span-2 card-molinero p-6">
            <div class="flex items-center justify-between mb-4 border-b border-[var(--border-color)] pb-3">
                <h2 class="text-sm font-bold text-[var(--text-primary)]">Últimos Convenios Registrados</h2>
                <a href="{{ route('admin.agreements.index') }}" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline">
                    Ver todos →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead class="text-[11px] text-[var(--text-muted)] uppercase border-b border-[var(--border-color)]">
                        <tr>
                            <th class="py-2">Código</th>
                            <th class="py-2">Institución</th>
                            <th class="py-2">País</th>
                            <th class="py-2">Estado</th>
                            <th class="py-2 text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-color)]">
                        @foreach($recentAgreements as $agr)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                            <td class="py-2.5 font-mono font-medium">{{ $agr->code ?: 'S/C' }}</td>
                            <td class="py-2.5 font-medium truncate max-w-[200px]">{{ $agr->institution->name }}</td>
                            <td class="py-2.5">{{ $agr->institution->country->name }}</td>
                            <td class="py-2.5">
                                <span class="badge-status badge-{{ $agr->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $agr->status)) }}
                                </span>
                            </td>
                            <td class="py-2.5 text-right">
                                <a href="{{ route('admin.agreements.edit', $agr->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
                                    Editar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Registro Reciente de Auditoría (Trazabilidad) -->
        <div class="card-molinero p-6">
            <div class="flex items-center justify-between mb-4 border-b border-[var(--border-color)] pb-3">
                <h2 class="text-sm font-bold text-[var(--text-primary)]">Trazabilidad Reciente</h2>
                <a href="{{ route('admin.audit.index') }}" class="text-xs font-semibold text-[#0F5132] dark:text-emerald-400 hover:underline">
                    Auditoría →
                </a>
            </div>

            <div class="space-y-3">
                @foreach($recentLogs as $log)
                <div class="text-xs p-2.5 rounded-lg bg-gray-50 dark:bg-emerald-950/20 border border-[var(--border-color)]">
                    <div class="flex items-center justify-between text-[11px] text-[var(--text-muted)] mb-1">
                        <span class="font-bold text-[var(--text-primary)]">{{ $log->user_name ?: 'Sistema' }}</span>
                        <span>{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-[var(--text-secondary)] leading-snug line-clamp-2">
                        {{ $log->details ?: $log->action . ' en ' . $log->entity_type }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
