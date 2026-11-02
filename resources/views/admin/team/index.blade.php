@extends('layouts.admin')

@section('title', 'Directorio del Equipo de Gestión OGI')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Equipo de Gestión OGI</h1>
            <p class="text-xs text-[var(--text-muted)]">Directorio institucional, directores y coordinadores mostrados en el portal público.</p>
        </div>

        <a href="{{ route('admin.team.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Agregar Miembro</span>
        </a>
    </div>

    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Foto</th>
                        <th class="py-3 px-4">Nombre y Apellidos</th>
                        <th class="py-3 px-4">Cargo / Función</th>
                        <th class="py-3 px-4">Contacto</th>
                        <th class="py-3 px-4">Orden</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($team as $member)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4">
                            @if($member->photo_path && file_exists(public_path($member->photo_path)))
                            <img src="{{ asset($member->photo_path) }}" alt="{{ $member->name }}" class="w-12 h-14 object-cover rounded-lg border border-[var(--border-color)] shadow-sm" />
                            @else
                            <img src="{{ asset('imagenes/placeholder_referencia.svg') }}" alt="Sin foto" class="w-12 h-14 object-cover rounded-lg border border-amber-300 dark:border-amber-700/60 shadow-sm" title="Fotografía pendiente de carga" />
                            @endif
                        </td>
                        <td class="py-3 px-4 font-bold text-[var(--text-primary)] max-w-xs">
                            <span class="block">{{ $member->name }}</span>
                            @if($member->department)
                            <span class="block text-[10px] text-[var(--text-muted)] font-normal">{{ $member->department }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-semibold text-emerald-800 dark:text-emerald-300">
                            {{ $member->role_title }}
                        </td>
                        <td class="py-3 px-4 space-y-0.5">
                            @if($member->email)
                            <a href="mailto:{{ $member->email }}" class="text-emerald-700 dark:text-emerald-400 hover:underline block truncate max-w-[150px]">{{ $member->email }}</a>
                            @endif
                            @if($member->phone)
                            <span class="text-gray-500 dark:text-gray-400 text-[10px] block">{{ $member->phone }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-bold">{{ $member->order }}</td>
                        <td class="py-3 px-4">
                            @if($member->is_active)
                            <span class="inline-flex items-center gap-1 text-emerald-600 dark:text-emerald-400 font-bold text-[11px]">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Activo
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-gray-400 font-medium text-[11px]">
                                <span class="w-2 h-2 rounded-full bg-gray-400"></span> Inactivo
                            </span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ route('admin.team.edit', $member->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">Editar</a>
                            <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar a este miembro del equipo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-xs text-[var(--text-muted)]">No hay miembros registrados en el equipo.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($team->hasPages())
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $team->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
