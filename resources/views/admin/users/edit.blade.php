@extends('layouts.admin')

@section('title', 'Editar Usuario: ' . $user->name)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.users.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
            ← Volver a usuarios
        </a>
        <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Editar Usuario</h1>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="card-molinero p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Nombre Completo *</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Correo Institucional *</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Cambiar Contraseña (dejar en blanco para conservar la actual)</label>
            <input type="password" name="password" placeholder="••••••••" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Rol de Acceso *</label>
            <select name="role" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor</option>
                <option value="revisor" {{ old('role', $user->role) === 'revisor' ? 'selected' : '' }}>Revisor</option>
                <option value="publicador" {{ old('role', $user->role) === 'publicador' ? 'selected' : '' }}>Publicador</option>
                <option value="admin_ogi" {{ old('role', $user->role) === 'admin_ogi' ? 'selected' : '' }}>Administrador OGI</option>
                <option value="consulta" {{ old('role', $user->role) === 'consulta' ? 'selected' : '' }}>Auditoría / Consulta</option>
                <option value="superadmin" {{ old('role', $user->role) === 'superadmin' ? 'selected' : '' }}>Superadministrador</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de la Cuenta *</label>
            <select name="is_active" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                <option value="1" {{ old('is_active', $user->is_active) ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !old('is_active', $user->is_active) ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-molinero text-xs">Guardar Cambios</button>
        </div>
    </form>
</div>
@endsection
