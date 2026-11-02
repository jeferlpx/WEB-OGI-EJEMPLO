@extends('layouts.admin')

@section('title', 'Gestión de Aliados Estratégicos')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Aliados Estratégicos y Redes</h1>
            <p class="text-xs text-[var(--text-muted)]">Organizaciones, agencias internacionales y consorcios mostrados en la portada e institucional.</p>
        </div>

        <a href="{{ route('admin.partners.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Agregar Aliado</span>
        </a>
    </div>

    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Logo</th>
                        <th class="py-3 px-4">Institución / Aliado</th>
                        <th class="py-3 px-4">Categoría</th>
                        <th class="py-3 px-4">Sitio Web</th>
                        <th class="py-3 px-4">Orden</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($partners as $partner)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4">
                            <div class="w-16 h-12 bg-white dark:bg-[#121F19] rounded-lg border border-[var(--border-color)] flex items-center justify-center p-1.5 shadow-sm">
                                @if($partner->logo_path && file_exists(public_path($partner->logo_path)))
                                <img src="{{ asset($partner->logo_path) }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain" />
                                @else
                                <img src="{{ asset('imagenes/placeholder_referencia.svg') }}" alt="Sin logo" class="max-h-full max-w-full object-contain opacity-75" title="Logotipo pendiente de carga" />
                                @endif
                            </div>
                        </td>
                        <td class="py-3 px-4 font-bold text-[var(--text-primary)] max-w-xs">
                            <span class="block truncate">{{ $partner->name }}</span>
                            @if($partner->description)
                            <span class="block text-[10px] text-[var(--text-muted)] font-normal truncate">{{ $partner->description }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold uppercase bg-emerald-100 dark:bg-emerald-950/60 text-[#0F5132] dark:text-emerald-400 border border-emerald-300 dark:border-emerald-800">
                                {{ str_replace('_', ' ', $partner->category) }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="text-emerald-700 dark:text-emerald-400 hover:underline max-w-[150px] truncate block">
                                {{ $partner->website_url }}
                            </a>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-bold">{{ $partner->order }}</td>
                        <td class="py-3 px-4">
                            @if($partner->is_active)
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
                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">Editar</a>
                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar este aliado estratégico?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-xs text-[var(--text-muted)]">No hay aliados estratégicos registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($partners->hasPages())
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $partners->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
