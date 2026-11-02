@extends('layouts.admin')

@section('title', 'Gestión de Usuarios y Roles')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-extrabold text-[var(--text-primary)]">Usuarios y Control de Acceso (RBAC)</h1>
            <p class="text-xs text-[var(--text-muted)]">Gestione las cuentas institucionales y los permisos de superadmin, director, editor y revisor.</p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn-molinero text-xs py-2 px-3 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Crear Usuario</span>
        </a>
    </div>

    <div class="card-molinero p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-gray-50 dark:bg-emerald-950/40 text-[var(--text-muted)] uppercase text-[11px] border-b border-[var(--border-color)]">
                    <tr>
                        <th class="py-3 px-4">Nombre</th>
                        <th class="py-3 px-4">Correo Institucional</th>
                        <th class="py-3 px-4">Rol Asignado</th>
                        <th class="py-3 px-4">Estado</th>
                        <th class="py-3 px-4">Último Ingreso</th>
                        <th class="py-3 px-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-color)]">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-emerald-950/20">
                        <td class="py-3 px-4 font-bold text-[var(--text-primary)]">{{ $user->name }}</td>
                        <td class="py-3 px-4 text-[var(--text-secondary)]">{{ $user->email }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-block px-2 py-0.5 text-[10px] uppercase font-bold rounded-full bg-emerald-500/20 text-emerald-700 dark:text-emerald-400 border border-emerald-500/30">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-[11px] font-semibold {{ $user->is_active ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $user->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-[var(--text-muted)]">
                            {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Nunca' }}
                        </td>
                        <td class="py-3 px-4 text-right space-x-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">Editar</a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Está seguro de eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline font-semibold">Eliminar</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-xs text-[var(--text-muted)]">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[var(--border-color)]">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
