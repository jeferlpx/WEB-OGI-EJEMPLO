@extends('layouts.admin')

@section('title', 'Crear Usuario Institucional')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <a href="{{ route('admin.users.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-semibold hover:underline">
            ← Volver a usuarios
        </a>
        <h1 class="text-xl font-extrabold text-[var(--text-primary)] mt-1">Crear Nuevo Usuario</h1>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="card-molinero p-6 space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Nombre Completo *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Correo Institucional (@lamolina.edu.pe) *</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Contraseña (mínimo 8 caracteres) *</label>
            <input type="password" name="password" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]" />
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Rol de Acceso *</label>
            <select name="role" required class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                <option value="editor">Editor (Crea y modifica borradores)</option>
                <option value="revisor">Revisor (Supervisa y deja observaciones)</option>
                <option value="publicador">Publicador (Autoriza y publica en portal)</option>
                <option value="admin_ogi">Administrador OGI (Gestión integral del área)</option>
                <option value="consulta">Auditoría / Consulta (Solo lectura)</option>
                <option value="superadmin">Superadministrador (Acceso total)</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-[var(--text-secondary)] mb-1">Estado de la Cuenta *</label>
            <select name="is_active" class="w-full text-xs px-3 py-2.5 rounded-lg border border-[var(--border-color)] bg-[var(--bg-page)] text-[var(--text-primary)] focus:outline-none focus:ring-2 focus:ring-[#0F5132]">
                <option value="1">Activo (Permite iniciar sesión)</option>
                <option value="0">Inactivo (Acceso bloqueado)</option>
            </select>
        </div>

        <div class="pt-4 border-t border-[var(--border-color)] flex justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="btn-molinero-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-molinero text-xs">Registrar Usuario</button>
        </div>
    </form>
</div>
@endsection
